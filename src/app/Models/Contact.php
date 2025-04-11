<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    use HasFactory;

    // contactsテーブルのカラムのうち操作可能にするもの
    protected $fillable = [
        'category_id',
        'last-name',
        'first-name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

   // categoriesテーブルとのリレーション定義すると$contact['category']とCategoryモデルの1レコードにアクセス可能
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Contactファクトリのルール
    public static $rules = array(

        'category_id' => 'required',
        'last-name' => 'required',
        'first-name' => 'required',
        'gender' => 'required',
        'email' => 'required|email',
        'tel' => 'required|integer|min:10|max:11',
        'address' => 'required',
        'building' => 'nullable',
        'detail' => 'required'

    );

}
