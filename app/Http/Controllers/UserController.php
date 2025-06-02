<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        $query = User::query();

        if ($currentUser->user_type === 'user') {
            $query->where('user_type', 'user');
        } elseif ($currentUser->user_type === 'staff') {
            $query->whereIn('user_type', ['user', 'staff']);
        }
        // admin sees all users

        $users = $query->get();

        return view('users.index', compact('users'));
    }
}

