<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Contracts\LogoutResponse;
use Illuminate\Pagination\Paginator;


// web.phpのルーティングで呼び出されるアクション
class AuthController extends Controller
{

    // 管理者HOME
    public function admin()
    {
        // contactモデルのレコードとそれに紐づくcategoryテーブルのレコードを取得
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        // ページネーション
        $contacts = Contact::Paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }

    // loginページからのリンク
    public function register()
    {
        return view('auth.register');
    }

    // registerページからのリンク
    public function login()
    {
        return view('auth.login');
    }

    // 検索機能
    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->CategorySearch($request->category_id)
            ->GenderSearch($request->gender)
            ->DateSearch($request->created_at)
            ->KeywordSearch($request->keyword)
            ->get();
        $categories = Category::all();

        // ページネーション
        $contacts = Contact::Paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }


    // public function store(UserRequest $request)
    // {
    //     // 値を取得したいキーを書く
    //     $user = $request->only(['name', 'email', 'password']);

    //     // $userの変数に格納されたデータを作成
    //     User::create($user);

    //     return view('admin');
    // }

}
