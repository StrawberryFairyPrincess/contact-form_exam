<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // categoriesテーブルのカラムのうち操作可能にするもの
    protected $fillable = [
        'content'
    ];
}
