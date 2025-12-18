<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductHistory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        // superAdmin hamma productlarni ko‘radi
        if ($currentUser->hasRole('superAdmin')) {
            $products = Product::with('creator')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        // admin faqat o'z qo'shgan productlar va o'z qo'shgan userlarning productlarini ko'radi
        elseif ($currentUser->hasRole('admin')) {
            // Adminning o'z productlari
            $ownProducts = Product::where('created_by', $currentUser->id)->pluck('id')->toArray();

            // Admin qo‘shgan userlar
            $usersIds = User::where('created_by', $currentUser->id)->pluck('id')->toArray();

            // Bu userlar tomonidan qo‘shilgan productlar
            $usersProducts = Product::whereIn('created_by', $usersIds)->pluck('id')->toArray();

            // Barchasini birlashtiramiz
            $productsIds = array_merge($ownProducts, $usersProducts);

            $products = Product::with('creator')
                ->whereIn('id', $productsIds)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // user faqat o'z productlarini ko'radi
        else {
            $products = Product::with('creator')
                ->where('created_by', $currentUser->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function productHistory(Request $request, $user_id)
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        // Agar superAdmin bo‘lsa — xohlagan user_id bo‘yicha ko‘ra oladi
        if ($currentUser->hasRole('superAdmin')) {

            $histories = ProductHistory::with(['product', 'user'])
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $histories
            ]);
        }

        // Admin bo‘lsa -> faqat o‘zi yoki o‘zi yaratgan user_id bo‘yicha ko‘ra oladi
        if ($currentUser->hasRole('admin')) {

            // Adminning o‘zi yaratgan userlar
            $createdUsers = User::where('created_by', $currentUser->id)->pluck('id')->toArray();

            // Adminning o‘zi yoki yaratgan user bo‘lishi shart
            if ($user_id != $currentUser->id && !in_array($user_id, $createdUsers)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Siz bu foydalanuvchining tarixini ko‘ra olmaysiz.'
                ], 403);
            }

            $histories = ProductHistory::with(['product', 'user'])
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $histories
            ]);
        }

        // Oddiy user -> faqat o‘z user_id bo‘yicha ko‘ra oladi
        if ($user_id != $currentUser->id) {
            return response()->json([
                'success' => false,
                'message' => 'Siz faqat o‘zingizning tarixingizni ko‘ra olasiz.'
            ], 403);
        }

        $histories = ProductHistory::with(['product', 'user'])
            ->where('user_id', $currentUser->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $histories
        ]);
    }


    public function getPriceByName(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $currentUser = auth()->user();

        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        $name = $request->name;

        // SuperAdmin barcha productlarni ko‘radi
        if ($currentUser->hasRole('superAdmin')) {
            $product = Product::select('id', 'name', 'price', 'quantity')
                ->where('name', $name)
                ->get();
        }
        // Admin faqat o'z va o'z userlari qo‘shgan productlarni ko‘radi
        elseif ($currentUser->hasRole('admin')) {
            $ownProducts = Product::where('created_by', $currentUser->id)->pluck('id');
            $usersIds = User::where('created_by', $currentUser->id)->pluck('id');
            $usersProducts = Product::whereIn('created_by', $usersIds)->pluck('id');
            $productsIds = $ownProducts->merge($usersProducts);

            $product = Product::select('id', 'name', 'price', 'quantity')
                ->where('name', $name)
                ->whereIn('id', $productsIds)
                ->get();
        }
        // Oddiy user faqat o‘z productlarini ko‘radi
        else {
            $product = Product::select('id', 'name', 'price', 'quantity')
                ->where('name', $name)
                ->where('created_by', $currentUser->id)
                ->get();
        }

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Mahsulot topilmadi yoki sizga ko‘rinmaydi.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'user_id' => 'nullable|integer|exists:users,id', // superAdmin boshqa user uchun yuborishi mumkin
        ]);

        $currentUser = auth()->user();
        $userId = $currentUser->id;

        // ❗ Agar superAdmin bo'lsa, user_id yuborishi mumkin
        if ($currentUser->hasRole('superAdmin') && $request->filled('user_id')) {
            $userId = $request->user_id;
        }

        // ❗ Agar admin bo'lsa, user_id ni faqat o‘z qo‘shgan userlar orasidan tanlashi mumkin
        elseif ($currentUser->hasRole('admin') && $request->filled('user_id')) {
            $allowedUserIds = User::where('created_by', $currentUser->id)->pluck('id')->toArray();
            $allowedUserIds[] = $currentUser->id; // admin o‘zini ham qo‘shadi

            if (!in_array($request->user_id, $allowedUserIds)) {
                return response()->json([
                    'message' => 'Siz faqat o‘z nomingiz yoki o‘z qo‘shgan userlar nomidan product qo‘sha olasiz.'
                ], 403);
            }

            $userId = $request->user_id;
        }

        // oddiy user -> userId = auth()->id(), request->user_id e’tiborga olinmaydi

        $name = strtolower(trim($request->name));

        // ❗ Shu user o‘zi yaratgan productni qidiramiz
        $product = Product::whereRaw('LOWER(name) = ?', [$name])
            ->where('created_by', $userId)
            ->first();

        // ❗ Agar product yo‘q — yaratamiz
        if (!$product) {
            $product = Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'created_by' => $userId,
            ]);

            return response()->json([
                'message' => 'Product created',
                'data' => $product
            ], 201);
        }

        // ❗ Product topilgan — narx mosmi?
        if ($product->price != $request->price) {
            return response()->json([
                'message' => 'Price mismatch',
                'old_price' => $product->price,
                'new_price' => $request->price,
                'action_required' => true,
                'options' => [
                    'change_old_price' => 'Eski narxni yangilab, quantity qo‘shib yuborish',
                    'create_new_product' => 'Yangi product yaratish'
                ]
            ], 409);
        }

        // ❗ Narx mos bo‘lsa — quantity qo‘shamiz
        $product->quantity += $request->quantity;
        $product->save();


        return response()->json([
            'message' => 'Quantity updated',
            'data' => $product
        ], 200);
    }


    public function updatePriceAndAdd(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'new_price' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        // Eski narxni yangilaymiz
        $product->price = $request->new_price;
        $product->quantity += $request->quantity;
        $product->save();

        // Historyga yozamiz
        ProductHistory::create([
           'product_id' => $product->id,
            'user_id' => $request->user_id,
            'edited_by' => auth()->id(),
            'action' => 'add quantity',
            'old_quantity' => $product->quantity,
            'quantity' => $request->quantity,
            'old_price' => $product->price,
            'price' => $request->new_price,
            'old_total_price' => $product->price * $product->quantity,
            'total_price' => $request->new_price * $request->quantity,
        ]);

        return response()->json([
            'message' => 'Price updated and quantity added',
            'data' => $product
        ], 200);
    }

    public function forceCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'created_by' => auth()->id(),
        ]);

        // Historyga yozamiz
        ProductHistory::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'New product created (old one unchanged)',
            'data' => $product
        ], 201);
    }



    public function show(Request $request)
    {
        $userId = auth()->id(); // login qilgan user ID

        $products = Product::with('creator') // creator relation bo‘lsa
            ->where('created_by', $userId) // faqat shu user productlari
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'message' => 'Products fetched successfully',
            'data' => $products
        ]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        // Validatsiya
        $request->validate([
            'id' => 'nullable|integer|exists:users,id',
            'userId' => 'nullable|integer|exists:users,id',
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|integer|min:1',
        ]);


        // Add ProductHistory
        $Product = ProductHistory::query()->create([
            'product_id' => $product->id,
            'user_id' => $request->input('userId'),
            'edited_by' => auth()->id(),
            'action' => 'update',
            'old_quantity' => $product->quantity,
            'quantity' => $request->input('quantity'),
            'old_price' => $product->price,
            'price' => $request->input('price'),
            'old_total_price' => $product->price * $product->quantity,
            'total_price' => $request->input('price') * $request->input('quantity'),
        ]);

        response()->json([
            'message' => 'ProductHistory created successfully',
            'data' => $Product
        ]);


        // Faqat null bo‘lmagan maydonlarni olamiz
        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->save();


        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product->load('creator')
        ]);
    }

    public function destroy($id)
    {
        // 1️⃣ Productni topamiz
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $ProductHistory = ProductHistory::query()->create([
           'product_id' => $product->id,
           'user_id' => auth()->id(),

           'action' => 'delete',
           'old_quantity' => $product->quantity,
           'quantity' => 0,
           'old_price' => $product->price,
           'price' => 0,
           'old_total_price' => $product->price * $product->quantity,
           'total_price' => 0,
        ]);

        response()->json([
            'message' => 'ProductHistory created successfully',
            'data' => $ProductHistory
        ]);

        // 2️⃣ Productni o‘chiramiz
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    public function productHistoryById(Request $request, $userId, $productId)
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan'
            ], 401);
        }

        // ================= SUPER ADMIN =================
        if ($currentUser->hasRole('superAdmin')) {

            $histories = ProductHistory::with(['user', 'product'])
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $histories
            ]);
        }

        // ================= ADMIN =================
        if ($currentUser->hasRole('admin')) {

            $createdUsers = User::where('created_by', $currentUser->id)
                ->pluck('id')
                ->toArray();

            // admin faqat o‘zi yoki yaratgan userni ko‘ra oladi
            if ($userId != $currentUser->id && !in_array($userId, $createdUsers)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Siz bu foydalanuvchining tarixini ko‘ra olmaysiz'
                ], 403);
            }

            $histories = ProductHistory::with(['user', 'product'])
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $histories
            ]);
        }

    }

}
