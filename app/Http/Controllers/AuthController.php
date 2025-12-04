<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register user
     */
   public function addUser(Request $request)
    {
        $currentUser = auth()->user(); // Hozirgi foydalanuvchi

        // 🔹 Agar foydalanuvchi login bo'lmagan bo'lsa
        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        // 🔹 Validation
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'nullable|string|exists:roles,name', // optional
        ]);

        // 🔹 Role logikasi
        $requestedRole = $request->role ?? 'user';

        if ($currentUser->hasRole('admin') && $requestedRole !== 'user') {
            return response()->json([
                'success' => false,
                'message' => 'Admin faqat user rolini bera oladi.'
            ], 403);
        }

        // 🔹 User yaratish
        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_by' => $currentUser->id, // admin yoki superAdmin ID sini saqlaymiz
        ]);

        // 🔹 Role olish yoki yaratish
        $role = Role::firstOrCreate(
            ['name' => $requestedRole],
            ['description' => ucfirst($requestedRole) . ' role']
        );

        // 🔹 Pivot jadvalga biriktirish
        $user->roles()->attach($role->id);

        // 🔹 Token yaratish
        $token = $user->createToken('auth_token')->plainTextToken;

        // 🔹 Response
        return response()->json([
            'success'      => true,
            'message'      => 'Foydalanuvchi muvaffaqiyatli yaratildi',
            'access_token' => $token,
            'user'         => $user->load('roles'),
            'token_type'   => 'Bearer'
        ], 201);
    }



    public function addAdminUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            // admin tomonidan yaratishda role optional emas, chunki doimo 'user' bo‘ladi
        ]);

        // 1️⃣ User yaratish
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2️⃣ Admin tomonidan yaratilyapti, shuning uchun rol doimo 'user'
        $role = Role::firstOrCreate(
            ['name' => 'user'],
            ['description' => 'User role']
        );

        // 3️⃣ Pivot jadvalga biriktirish
        $user->roles()->attach($role->id);

        // 4️⃣ Token yaratish (faqat API uchun, login qilganda kerak)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered by admin',
            'access_token' => $token,
            'user' => $user->load('roles'),
            'token_type' => 'Bearer'
        ], 201);
    }


    public function profile(Request $request)
    {
        $user = $request->user(); // Login qilgan userni olish

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => $user, // faqat login qilgan user
            'user' => $user->load('roles')
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user(); // login qilgan user

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        // Validatsiya
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6|confirmed', // agar password update bo‘lsa
        ]);


        // Agar password bor bo‘lsa, hash qilish
        if(isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        // User update
        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }


    // UPDATE USER
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'email'    => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Role update (agar kerak bo‘lsa)
        if ($request->has('role')) {
            $role = Role::firstOrCreate(
                ['name' => $request->role],
                ['description' => ucfirst($request->role) . ' role']
            );
            $user->roles()->sync([$role->id]); // eski rollarni o‘chirib yangi rol biriktiradi
        }

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user->load('roles')
        ]);
    }

    public function show($id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success'=>false, 'message'=>'Foydalanuvchi topilmadi']);
        }
        return response()->json(['success'=>true, 'data'=>$user]);
    }


    // DELETE USER
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Pivot jadvaldagi rollarni o‘chirish
        $user->roles()->detach();

        // Userni o‘chirish
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }

    public function user(Request $request)
    {
        $user = $request->user(); // Login qilgan userni olish

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => [$user] // faqat login qilgan user
        ]);
    }





    /**
     * Login user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email yoki parol noto‘g‘ri.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $roles = $user->roles()->pluck('name');
        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'user' => $user,
            'roles' => $roles,
            'token_type' => 'Bearer'
        ]);
    }


    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }

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
            // superAdmin hamma foydalanuvchilarni ko'radi, lekin o'zini emas
            $users = User::with('roles')
                ->where('id', '!=', $currentUser->id)
                ->get();
        } elseif ($currentUser->hasRole('admin')) {
            // admin faqat o'z qo'shgan userlarini ko'radi, o'zini emas
            $users = User::with('roles')
                ->where('created_by', $currentUser->id)
                ->where('id', '!=', $currentUser->id)
                ->get();
        } else {
            // oddiy user boshqa foydalanuvchilarni ko'rmaydi, shuning uchun bo'sh collection
            $users = collect();
        }

        return response()->json([
            'success' => true,
            'data'    => $users
        ], 200);
    }

    public function getUsers()
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        if ($currentUser->hasRole('superAdmin')) {
            // superAdmin hamma foydalanuvchilarni, o'zini ham ko'radi
            $users = User::with('roles')->get();

        } elseif ($currentUser->hasRole('admin')) {
            // admin faqat o'z qo'shgan userlarini, o'zini ham ko'radi
            $users = User::with('roles')
                ->where(function ($q) use ($currentUser) {
                    $q->where('created_by', $currentUser->id)
                        ->orWhere('id', $currentUser->id); // o‘zini qo‘shamiz
                })
                ->get();

        } else {
            // oddiy user faqat o'zini ko'ra oladi
            $users = User::with('roles')
                ->where('id', $currentUser->id)
                ->get();
        }

        return response()->json([
            'success' => true,
            'data'    => $users
        ], 200);
    }




}
