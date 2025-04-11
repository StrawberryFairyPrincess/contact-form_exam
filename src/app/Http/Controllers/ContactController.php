<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ContactモデルをContactControllerで使用する
use App\Models\Contact;
// フォームリクエストをContactControllerから呼び出す
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // web.phpのルーティングで呼び出されるindexアクション
    public function index()
    {
        // index.blade.phpを表示する
        return view('index');
    }


}
