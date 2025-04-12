<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

use App\Models\Contact;
use App\Models\Category;
use App\Models\User;

// web.phpのルーティングで呼び出されるアクション
class ContactController extends Controller
{

    public function index()
    {
        // Contactsテーブルのレコードと、それに紐づくcategoriesテーブルのレコードをセットで取得
        $contacts = Contact::with('category')->get();

        // Categoryモデルで設定した条件に基づきcategoriesテーブルを全部取得
        $categories = Category::all();

        // index.blade.phpを表示して、入力情報が入った変数$contacts、$categoriesを渡す
        return view('index', compact('contacts', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {

        // 値を取得したいキー
        $contact = $request->only([
            'category_id',
            'last-name',
            'first-name',
            'gender',
            'email',
            'tel-area',
            'tel-city',
            'tel-subscriber',
            'address',
            'building',
            'detail'
        ]);

        $categories = Category::all();
        foreach( $categories as $category )
        {
            if( $category['id'] == $contact['category_id'] )
            {
                break;
            }
        }

        // confirm.blade.phpを表示して、$contact、$categoryをキー'contact'、'category'で渡す
        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        // 値を取得したいキーを書く
        $contact = $request->only([
            'category_id',
            'last-name',
            'first-name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail'
        ]);

        // $contactの変数に格納されたデータを作成
        Contact::create($contact);

        // thanks.blade.phpを表示する
        return view('thanks');
    }


}
