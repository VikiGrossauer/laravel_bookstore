<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUser($userId){
        $user = User::with(['orders', 'books'])->where('id', $userId)->first();
        return response()->json($user, 200);
    }
}
