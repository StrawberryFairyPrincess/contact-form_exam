<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class ContactCsvService {

    const CSV_EXPORT_HEADER = [
        "id",
        "category_id",
        "last_name",
        "first_name",
        "gender",
        "email",
        "tel",
        "address",
        "building",
        "detail",
        "created_at",
        "updated_at",
    ];

    public function contactExport()
    {

    $contacts = Contact::all(['id', 'name', 'email'])->toArray();

    $csvContent = fopen('php://temp', 'r+'); // 一時的なストリーム
    fputcsv($csvContent, ['ID', '名前', 'メールアドレス']); // 日本語のヘッダー
    foreach ($contacts as $contact) {
        fputcsv($csvContent, $contact);
    }
    rewind($csvContent); // ストリームのポインタを先頭に戻す

    // UTF-8からShift-JISへ変換
    $csvData = stream_get_contents($csvContent);
    $sjisData = mb_convert_encoding($csvData, 'SJIS-win', 'UTF-8');
    fclose($csvContent);

    // CSVファイルをダウンロード
    return Response::make($sjisData, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="contacts.csv"',
    ]);










        // // データベースからユーザー情報を取得
        // $contacts = Contact::all(['id', 'name', 'email'])->with('category')->toArray();

        // // CSVデータを生成
        // $csvContent = fopen('php://output', 'w');
        // // ヘッダー行
        // fputcsv($csvContent, ['ID', 'Last Name', 'First Name', 'Gender', 'Email', 'Tel', 'Address', 'Building', 'Detail', 'Category Content']);
        // foreach ($contacts as $contact) {
        //     fputcsv($csvContent, $contact);
        // }
        // fclose($csvContent);

        // // CSVファイルをダウンロード
        // return response()->streamDownload(function () use ($csvContent) {
        //     echo $csvContent;
        // }, 'contacts.csv', ['Content-Type' => 'text/csv']);



        // // ファイルヘッダーとなる文字列作成
        // $header = collect(self::CSV_EXPORT_HEADER)->implode(",");
        // mb_convert_variables('SJIS', 'UTF-8', $header);

        // // select句になる文字列作成
        // $selectStr = collect(self::CSV_EXPORT_HEADER)->map(function($item) {
        //     return "ifnull({$item}, '')";
        // })->implode(", ',' ,");

        // // データの取得
        // $contacts = DB::table('contacts')
        // ->select(DB::raw("concat({$selectStr}) record"))
        // ->pluck("record");

        // // ヘッダーとデータを加えて改行コードでつなげて１つの文字列にする
        // return $contacts->prepend($header)->implode("\r\n");
    }
}


