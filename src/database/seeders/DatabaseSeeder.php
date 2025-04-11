<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // categoriesテーブルへのシーディング処理
        $this->call(CategoriesTableSeeder::class);

        // contactsテーブルへのシーディング処理（ファクトリ使用）
        // 先にリレーション先categoryを作らないと作れない
        Contact::factory()->count(35)->create();
    }
}
