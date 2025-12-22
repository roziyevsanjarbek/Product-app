<?php

namespace App\Http\Controllers;

use App\Models\ProductHistory;
use App\Models\SaleHistory;
use App\Models\User;
use App\Models\UserHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function allHistoryByProduct()
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }
        if($user->hasRole('superAdmin')){
            $history = ProductHistory::query()->with(['user', 'product'])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        }

        // admin faqat o'zini va yaratganlarini ko'rsin
        if($user->hasRole('admin')){

            // 1️⃣ admin yaratgan userlar ID lari
            $createdUserIds = User::query()
                ->where('created_by', $user->id)
                ->pluck('id')
                ->toArray();

            // 2️⃣ ProductHistory larni filtrlash:
            // user_id == admin id OR user_id in createdUserIds
            $history = ProductHistory::query()
                ->whereIn('user_id', array_merge([$user->id], $createdUserIds))
                ->with(['user', 'product'])
                ->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'You are not authorized to view this page'
        ]);

    }

    public function allHistoryByUser()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        // superAdmin hamma tarixni oladi
        if ($user->hasRole('superAdmin')) {
            $history = UserHistory::query()->with(['user', 'editor'])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        }

        // admin faqat o'zini va yaratganlarini ko'rsin
        if ($user->hasRole('admin')) {

            // 1️⃣ admin yaratgan userlar ID lari
            $createdUserIds = User::query()
                ->where('created_by', $user->id)
                ->pluck('id')
                ->toArray();

            // 2️⃣ UserHistory larni filtrlash:
            // edited_by == admin id OR user_id in createdUserIds
            $history = UserHistory::query()
                ->where(function ($query) use ($user, $createdUserIds) {
                    $query->where('edited_by', $user->id)
                        ->orWhereIn('user_id', $createdUserIds);
                })
                ->with(['user', 'editor'])
                ->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'You are not authorized to view this page'
        ], 403);
    }

    public function allHistoryBySale()
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        // superAdmin hamma tarixni oladi
        if($user->hasRole('superAdmin')){
            $history = SaleHistory::query()->with(['user', 'product'])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        }

        // admin faqat o'zini va yaratgan userlarining sotuvlarini ko'rsin
        if($user->hasRole('admin')){
            // admin yaratgan userlar
            $createdUserIds = User::query()
                ->where('created_by', $user->id)
                ->pluck('id')
                ->toArray();

            // SaleHistory filtrlash: user_id == admin id OR user_id in createdUserIds
            $history = SaleHistory::query()
                ->whereIn('user_id', array_merge([$user->id], $createdUserIds))
                ->with(['user', 'product'])
                ->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'You are not authorized to view this page'
        ], 403);
    }


    public function saleHistorySearchDate(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $query = SaleHistory::query()->with(['user', 'product']);

        // Rolega qarab limitlash
        if(!$user->hasRole('superAdmin')){
            // admin faqat o'zini va yaratgan userlarini ko'rsin
            $createdUserIds = User::query()
                ->where('created_by', $user->id)
                ->pluck('id')
                ->toArray();

            $query->whereIn('user_id', array_merge([$user->id], $createdUserIds));
        }

        // 🔹 from (boshlanish sanasi)
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        // 🔹 to (tugash sanasi)
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $histories = $query->get();

        return response()->json([
            'success' => true,
            'data' => $histories
        ]);
    }

    public function productHistorySearchDate(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $query = ProductHistory::query()->with(['user', 'product']);

        // Rolega qarab limitlash
        if(!$user->hasRole('superAdmin')){
            // admin faqat o'zini va yaratgan userlarini ko'rsin
            $createdUserIds = User::query()
                ->where('created_by', $user->id)
                ->pluck('id')
                ->toArray();

            $query->whereIn('user_id', array_merge([$user->id], $createdUserIds));
        }

        // 🔹 Sanadan
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        // 🔹 Sanagacha
        if ($request->filled('to')) {
            $query->where('created_at', '<=', Carbon::parse($request->to)->endOfDay());
        }

        // 🔹 Action filter
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    public function userHistorySearchDate(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $query = UserHistory::with(['user', 'editor'])
            ->orderBy('created_at', 'desc');

        // 🔹 Rolega qarab limitlash
        if (!$user->hasRole('superAdmin')) {
            // admin faqat o'zini va yaratgan userlarini ko'rsin
            $createdUserIds = User::where('created_by', $user->id)
                ->pluck('id')
                ->toArray();

            $query->whereIn('user_id', array_merge([$user->id], $createdUserIds));
        }

        // 🔹 Sanadan
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        // 🔹 Sanagacha
        if ($request->filled('to')) {
            $query->where('created_at', '<=', Carbon::parse($request->to)->endOfDay());
        }

        // 🔹 Role filter (new_role)
        if ($request->filled('role')) {
            $query->where('new_role', $request->role);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }


    public function saleSearchAction(Request $request)
    {
        $request->validate([
            'action' => 'required',
        ]);

        $user = auth()->user();

        $query = SaleHistory::query()
            ->with(['user', 'product'])
            ->where('action', $request->action)
            ->orderByDesc('created_at');

        // 🔐 Role check
        if (!$user->hasRole('superAdmin')) {
            $createdUserIds = User::where('created_by', $user->id)->pluck('id')->toArray();
            $query->whereIn('user_id', array_merge([$user->id], $createdUserIds));
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }


    public function productSearchAction(Request $request)
    {
        $request->validate([
            'action' => 'required',
        ]);

        $user = auth()->user();

        $query = ProductHistory::query()
            ->with(['user', 'product'])
            ->where('action', $request->action)
            ->orderByDesc('created_at');

        // 🔐 Role check
        if (!$user->hasRole('superAdmin')) {
            $createdUserIds = User::where('created_by', $user->id)->pluck('id')->toArray();
            $query->whereIn('user_id', array_merge([$user->id], $createdUserIds));
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }


    public function userSearchAction(Request $request)
    {
        $request->validate([
            'action' => 'required',
        ]);

        $user = auth()->user();

        $query = UserHistory::query()
            ->with(['user', 'editor'])
            ->where('action', $request->action)
            ->orderByDesc('created_at');

        if (!$user->hasRole('superAdmin')) {
            $createdUserIds = User::where('created_by', $user->id)->pluck('id')->toArray();

            $query->where(function ($q) use ($user, $createdUserIds) {
                $q->where('edited_by', $user->id)
                    ->orWhereIn('user_id', $createdUserIds);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }



}
