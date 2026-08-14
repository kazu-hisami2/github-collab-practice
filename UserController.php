<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', ['users' => $users]);
    }

    public function store(Request $request)
    {
        // 入力値のバリデーション
        $validated = $request->$validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ])

        // 入力値の登録
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), //パスワードはhash化して保存
        ]);

        return redirect('/users');
    }
}
