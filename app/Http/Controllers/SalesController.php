<?php

namespace App\Http\Controllers;

use App\Models\SaleHistory;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    // Barcha sotuvlarni olish
    public function index()
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        if ($currentUser->hasRole('superAdmin')) {
            $sales = Sales::with(['product', 'creator'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } elseif ($currentUser->hasRole('admin')) {
            // Admin o'z qo'shgan sales
            $ownSales = Sales::where('created_by', $currentUser->id)->pluck('id');

            // Admin qo'shgan userlar
            $usersIds = User::where('created_by', $currentUser->id)->pluck('id');

            // Bu userlar tomonidan qo‘shilgan sales
            $usersSales = Sales::whereIn('created_by', $usersIds)->pluck('id');

            $salesIds = $ownSales->merge($usersSales);

            $sales = Sales::with(['product', 'creator'])
                ->whereIn('id', $salesIds)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // user faqat o'z saleslarini ko'radi
            $sales = Sales::with(['product', 'creator'])
                ->where('created_by', $currentUser->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return response()->json([
            'success' => true,
            'data' => $sales
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $userId = auth()->id();

        // ❗ Faqat o'ziga tegishli productni topamiz
        $product = Product::where('id', $request->product_id)
            ->where('created_by', $userId)
            ->first();

        if (!$product) {
            return response()->json([
                'message' => 'Siz faqat o‘zingizga tegishli mahsulotni sota olasiz'
            ], 403);
        }

        // ❗ Omborda yetarlimi?
        if ($request->quantity > $product->quantity) {
            return response()->json([
                'message' => 'Not enough product in stock',
                'quantity' => $product->quantity
            ], 400);
        }

        DB::transaction(function () use ($request, $product, $userId) {

            // 🔥 SALE SAQLANADI
            Sales::create([
                'product_id'  => $product->id,
                'quantity'    => $request->quantity,
                'total_price' => $request->quantity * $product->price,
                'created_by'  => $userId,
            ]);

            // 🔥 PRODUCT STOCK KAMAYADI
            $product->decrement('quantity', $request->quantity);
        });

        return response()->json([
            'message' => 'Sale added successfully'
        ], 201);
    }

    public function show()
    {
        $userId = auth()->id(); // login qilgan user ID

        $sales = Sales::with(['product', 'creator'])
            ->where('created_by', $userId) // faqat shu userga tegishli
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'message' => 'Sales fetched successfully',
            'data' => $sales
        ]);
    }


    public function update(Request $request, $id)
    {
        $sale = Sales::find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'
        ]);
        $product = $sale->product;
        // Add SaleHistory
        $Sale = SaleHistory::query()->create([
            'sale_id' => $sale->id,
            'user_id' => $request->user_id,
            'product_id' => $product->id,
            'action' => 'update',
            'edited_by' => auth()->id(),
            'old_quantity' => $sale->quantity,
            'quantity' => $request->quantity,
            'old_price' => $product->price,
            'price' => $request->price,
            'old_total_price' => $sale->price * $sale->quantity,
            'total_price' => $sale->price * $request->quantity,

        ]);

        response()->json([
            'message' => 'SaleHistory created successfully',
            'data' => $Sale
        ]);

        // Avvalgi sale miqdorini qaytaramiz productga
        $product->quantity += $sale->quantity;

        // Tekshiramiz: yetarli product mavjudmi
        if ($request->quantity > $product->quantity) {
            return response()->json([
                'message' => 'Not enough product in stock'
            ], 400);
        }

        // Sale miqdorini yangilaymiz
        $sale->quantity = $request->quantity;
        $sale->total_price = $request->quantity * $product->price;
        $sale->save();

        // Product miqdorini kamaytirish
        $product->quantity -= $request->quantity;
        $product->save();

        return response()->json([
            'message' => 'Sale updated successfully',
            'data' => $sale->load('product', 'creator'),
            'Update SaleHistory:' => $Sale
        ]);
    }

    public function destroy($id)
    {
        $sale = Sales::query()->find($id);

        if (!$sale || $sale->trashed()) {
            return response()->json(['message' => 'Sale not found or already deleted'], 404);
        }

        $history = SaleHistory::query()->create([
            'sale_id' => $sale->id,
            'user_id' => auth()->id(),
            'action' => 'delete',
            'edited_by' => auth()->id(),
            'product_id' => $sale->product->id,
            'old_quantity' => 0,
            'quantity' => $sale->quantity,
            'old_price' => 0,
            'price' => $sale->total_price / $sale->quantity,
            'old_total_price' => 0,
            'total_price' => $sale->total_price
        ]);



        return response()->json([
            'message' => 'Sale deleted successfully',
            'deleted SaleHistory:' => $history
        ]);
    }

    public function restore($id)
    {
        $sale = Sales::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($sale) {
            // Product quantity kamaytirish
            $sale->product->decrement('quantity', $sale->quantity);

            // Restore
            $sale->restore();
            $sale->deleted_by = null;
            $sale->save();
        });

        return response()->json(['message' => 'Sale restored successfully']);
    }

    public function history()
    {
        $sales = Sales::withTrashed()
            ->with(['product', 'creator', 'deletedBy'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($sale) {
                return [
                    'product' => $sale->product->name ?? 'Noma’lum',
                    'quantity' => $sale->quantity,
                    'total_price' => $sale->total_price,
                    'user' => $sale->creator->name ?? 'Noma’lum', // ⚠ shu o‘zgardi
                    'date' => $sale->created_at->format('d.m.Y H:i'),
                    'status' => $sale->deleted_at ? 'O‘chirilgan' : 'Sotilgan',
                    'deleted_by' => $sale->deletedBy->name ?? null,
                ];
            });

        return response()->json($sales);
    }


}
