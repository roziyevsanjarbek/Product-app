<?php

namespace App\Http\Controllers;

use App\Models\ProductHistory;
use App\Models\SaleHistory;
use App\Models\User;
use App\Models\UserHistory;
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
            $history = ProductHistory::query()->with(['user', 'product'])->get();
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
                ->get();

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
            $history = UserHistory::query()->with(['user', 'editor'])->get();
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
                ->get();

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
            $history = SaleHistory::query()->with(['user', 'product'])->get();
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
                ->get();

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


}
