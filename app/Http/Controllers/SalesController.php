<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;

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
                ->get();
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
                ->get();
        } else {
            // user faqat o'z saleslarini ko'radi
            $sales = Sales::with(['product', 'creator'])
                ->where('created_by', $currentUser->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return response()->json([
            'success' => true,
            'data' => $sales
        ]);
    }


    // Yangi sotuv qo'shish
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'user_id' => 'nullable|integer|exists:users,id', // superAdmin/admin boshqa user nomidan sotish uchun
        ]);

        $currentUser = auth()->user();
        $creatorId = $currentUser->id; // default: sotuvchi = login qilgan user

        // ❗ superAdmin boshqa user nomidan sotishi mumkin
        if ($currentUser->hasRole('superAdmin') && $request->filled('user_id')) {
            $creatorId = $request->user_id;
        }
        // ❗ admin faqat o'z yoki o'z qo'shgan userlar nomidan sotishi mumkin
        elseif ($currentUser->hasRole('admin') && $request->filled('user_id')) {
            $allowedUserIds = User::where('created_by', $currentUser->id)->pluck('id')->toArray();
            $allowedUserIds[] = $currentUser->id; // admin o'zini ham qo'shadi

            if (!in_array($request->user_id, $allowedUserIds)) {
                return response()->json([
                    'message' => 'Siz faqat o‘z nomingiz yoki o‘z qo‘shgan userlar nomidan sotishingiz mumkin.'
                ], 403);
            }

            $creatorId = $request->user_id;
        }
        // oddiy user -> $creatorId = auth()->id()

        $product = Product::find($request->product_id);

        // Tekshiramiz: yetarli product mavjudmi
        if ($request->quantity > $product->quantity) {
            return response()->json([
                'message' => 'Not enough product in stock'
            ], 400);
        }

        // Total price hisoblash
        $totalPrice = $request->quantity * $product->price;

        // Sale yaratish
        $sale = Sales::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'created_by' => $creatorId,
        ]);

        // Product miqdorini kamaytirish
        $product->quantity -= $request->quantity;
        $product->save();

        return response()->json([
            'message' => 'Sale added successfully',
            'data' => $sale->load('product', 'creator')
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
            'quantity' => 'required|integer|min:1',
        ]);

        $product = $sale->product;

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
            'data' => $sale->load('product', 'creator')
        ]);
    }

    public function destroy($id)
    {
        $sale = Sales::find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        $product = $sale->product;

        // Product miqdorini tiklash
        $product->quantity += $sale->quantity;
        $product->save();

        // Sale o'chirish
        $sale->delete();

        return response()->json([
            'message' => 'Sale deleted successfully'
        ]);
    }


}
