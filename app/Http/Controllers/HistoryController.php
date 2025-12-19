<?php

namespace App\Http\Controllers;

use App\Models\ProductHistory;
use App\Models\SaleHistory;
use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function allHistoryByProduct($userId)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }
        if(!$user->hasRole('superAdmin')){
            $history = ProductHistory::query()->with('user')->get();
            return response()->json([
                'success' => true,
                'data' => $history
            ]);
        }
        if($user->hasRole('admin')){

            $createUser = User::query()
                ->where('created_by', $user->id)
                ->pluck('id')
                ->toArray();

            if($userId != $user->id && !in_array($userId, $createUser)){
                return response()->json([
                    'success' => false,
                ], 403);
            }

            $history = ProductHistory::query()
                ->where('user_id', $userId)
                ->with('user')
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
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $history = UserHistory::query()->with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $history
        ]);

    }
    public function getSaleHistory()
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }
        $history = SaleHistory::query()->with('user')->get();
        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }
}
