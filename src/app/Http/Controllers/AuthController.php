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
use App\Services\ContactCsvService;


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

    // 削除機能
    public function destroy(Request $request)
    {
        // idと一致するレコードを削除
        Contact::find($request->id)->delete();

        return redirect('admin');
    }

    // CSVエクスポート機能
    protected $service;
    public function __construct(ContactCsvService $service)
    {
        $this->service = $service;
    }
    public function contactExport()
    {
        $data = $this->service->contactExport();
        return response($data , 200);
    }




    // public function export(Request $request)
    // {
    //     // データ取得
    //     $contacts = Contact::with('category')->get();

    //     // カラム名
    //     $header = [
    //         'ID','姓','名','性別','メールアドレス','電話番号','住所','建物名','お問い合わせの種類','お問い合わせ内容'
    //     ];

    //     // 書き込み用ファイルを開く
    //     $f = fopen('contact.csv', 'w');
    //     if ($f) {
    //         // カラムの書き込み
    //         mb_convert_variables('SJIS', 'UTF-8', $header);
    //         fputcsv($f, $header);

    //         // データの書き込み
    //         foreach ($contacts as $contact) {
    //             mb_convert_variables('SJIS', 'UTF-8', $contact);
    //             fputcsv($f, $contact);
    //         }
    //     }

    //     // ファイルを閉じる
    //     fclose($f);

    //     // HTTPヘッダ
    //     header("Content-Type: application/octet-stream");
    //     header('Content-Length: '.filesize('contact.csv'));
    //     header('Content-Disposition: attachment; filename=contact.csv');
    //     readfile('contact.csv');

    //     return view('admin', compact('contacts'));
    // }



    // public function export(Request $request){

    //     $contacts = Contact::with('category')->get();

    //     $csvHeader = [
    //         'ID','姓','名','性別','メールアドレス','電話番号','住所','建物名','お問い合わせの種類','お問い合わせ内容'
    //     ];
    //     $csvData = $contacts->toArray();

    //     $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
    //         $handle = fopen('php://output', 'w');
    //         fputcsv($handle, $csvHeader);

    //         foreach ($csvData as $row) {
    //             fputcsv($handle, $row);
    //         }

    //         fclose($handle);
    //     }, 200, [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename="contacts.csv"',
    //     ]);

    //     return view('admin', $response);


        // $contacts = Contact::with('category')->get();

        // $csvHeader = [
        //     'ID','姓','名','性別','メールアドレス','電話番号','住所','建物名','お問い合わせの種類','お問い合わせ内容'
        // ];

        // $temps = [];
        // array_push($temps, $csvHeader);

        // foreach ($contacts as $contact) {
        //     $temp = [
        //         $contact->id,
        //         $contact->last-name,
        //         $contact->first-name,
        //         $contact->gender,
        //         $contact->email,
        //         $contact->tel,
        //         $contact->address,
        //         $contact->building,
        //         $contact->category_id->content,
        //         $contact->detail
        //         ];
        //     array_push($temps, $temp);
        // }

        // $stream = fopen('php://temp', 'r+b');

        // foreach ($temps as $temp) {
        //     fputcsv($stream, $temp);
        // }
        // rewind($stream);
        // $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        // $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
        // $now = new Carbon();
        // $filename = "ユーザー一覧（全件：" . $now->format('Y年m月d日'). "）.csv";
        // $headers = array(
        //     'Content-Type' => 'text/csv',
        //     'Content-Disposition' => 'attachment; filename='.$filename,
        // );
        // return Response::make($csv, 200, $headers);

    // }


    // public function store(UserRequest $request)
    // {
    //     // 値を取得したいキーを書く
    //     $user = $request->only(['name', 'email', 'password']);

    //     // $userの変数に格納されたデータを作成
    //     User::create($user);

    //     return view('admin');
    // }
}
