<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

// web.phpのルーティングで呼び出されるアクション
class AuthController extends Controller
{
    public function admin()
    {
        return view('admin');
    }

    public function store(UserRequest $request)
    {
        // 値を取得したいキーを書く
        $user = $request->only(['name', 'email', 'password']);

        // $userの変数に格納されたデータを作成
        User::create($user);

        return view('admin');
    }








}
