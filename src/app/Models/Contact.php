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
        'last-name' => 'required|string|max:255',
        'first-name' => 'required|string|max:255',
        'gender' => 'required|min:1|max:3',
        'email' => 'required|email|string|max:255',
        'tel' => 'required|numeric|min:10|max:11',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
        'detail' => 'required|string|max:255'

    );

    // scopeがついてるのはローカルスコープ(SQLをメソッドとして書く)
    // 引数で指定した値$category_idが空じゃなかったら'category_id'カラムで検索を行う
    // お問い合わせの種類
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }
    // 性別
    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
            if( $gender == 4 ){
                $query->where('gender', 1)
                    ->orWhere('gender', 2)
                    ->orWhere('gender', 3);
            }
            else{
                $query->where('gender', $gender);
            }
        }
    }
    // 日付
    public function scopeDateSearch($query, $created_at){
        if (!empty($created_at)) {
            $query->whereDate('created_at', $created_at);
        }
    }

    // 引数で指定した値$keywordが空じゃなかったらcontactsテーブルで検索を行う
    // 苗字、名前、メールアドレス
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('last-name', 'like', '%' . $keyword . '%')
                ->orWhere('first-name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        }
    }

}
