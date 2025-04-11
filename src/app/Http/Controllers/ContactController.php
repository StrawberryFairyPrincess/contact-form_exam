<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

use App\Models\Contact;
use App\Models\Category;
use App\Models\User;



class ContactController extends Controller
{
    // web.phpのルーティングで呼び出されるindexアクション
    public function index()
    {
        // Contactsテーブルのレコードと、それに紐づくcategoriesテーブルのレコードをセットで取得
        $contacts = Contact::with('category')->get();

        // Categoryモデルで設定した条件に基づきcategoriesテーブルを全部取得
        $categories = Category::all();

        // index.blade.phpを表示して、入力情報が入った変数$contacts、$categoriesを渡す
        return view('index', compact('contacts', 'categories'));
    }


}
