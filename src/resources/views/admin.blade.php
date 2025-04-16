@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

  <div class="admin__heading">
    <h2>Admin</h2>
  </div>

  <div class="admin__content">
    <div class="admin__search">

      <div class="form__style">
        <form class="search-form" action="/search" method="GET">
          @csrf

            {{-- キーワード検索 --}}
            <div class="form-flex">
              <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください ">
            </div>

            {{-- 性別検索 --}}
            <div class="form-flex">
              <div class="form-box">
                <select class="search-form__item-select" name="gender">
                  <option value="">性別</option>
                  <option value="1">男性</option>
                  <option value="2">女性</option>
                  <option value="3">その他</option>
                  <option value="4">全て</option>
                </select>
              </div>
            </div>

            {{-- お問い合わせの種類の検索 --}}
            <div class="form-flex">
              <div class="form-box">
                <select class="search-form__item-select" name="category_id">
                  <option value="">お問い合わせの種類</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- 作成日検索 --}}
            <div class="form-flex">
              <div class="form-box">
                <input class="search-form__item-date" type="date" name="created_at" value="{{ old('created_at') }}">
              </div>
            </div>

            {{-- 検索ボタン --}}
            <div class="form-flex">
              <button class="search-form__button-submit" type="submit">検索</button>
            </div>

            {{-- リセットボタン --}}
            <div class="form-flex">
              <input class="search-form__button-reset" type="button" onclick="location.href='/admin'" value="リセット">
            </div>

        </form>
      </div>

      <div class="export">
        <input type="button" value="エクスポート">
      </div>

      <div class="paginate">

          @foreach( $contacts as $contact )

              {{ $contact->title }}

          @endforeach

        {{ $contacts->links() }}
      </div>
    </div>

    <div class="contact-table">
      <table class="contact-table__inner">

        <tr class="contact-table__row">
          <th class="contact-table__header">
            <span class="contact-table__header-span">お名前</span>
          </th>
          <th class="contact-table__header">
            <span class="contact-table__header-span">性別</span>
          </th>
          <th class="contact-table__header">
            <span class="contact-table__header-span">メールアドレス</span>
          </th>
          <th class="contact-table__header">
            <span class="contact-table__header-span">お問い合わせの種類</span>
          </th>
        </tr>

        {{-- AuthControllerで取得したcontactsテーブルのひとつの内容contentを表示 --}}
        @foreach($contacts as $contact)
        <tr class="contact-table">

          <td class="record">

            {{-- お名前 --}}
            <input class="contact__item" type="text" name="full-name" value="{{ $contact['last-name'] . '　' . $contact['first-name'] }}" readonly />

          </td>
          <td class="record">

            {{-- 性別 --}}
            @if( $contact['gender'] == 1 )
                <input class="contact__item" type="text" name="gender" value="男性" readonly />
            @elseif( $contact['gender'] == 2 )
                <input class="contact__item" type="text" name="gender" value="女性" readonly />
            @elseif( $contact['gender'] == 3 )
                <input class="contact__item" type="text" name="gender" value="その他" readonly />
            @endif

          </td>
          <td class="record">

            {{-- メールアドレス --}}
            <input class="contact__item" type="text" name="email" value="{{ $contact['email'] }}" readonly />

          </td>
          <td class="record">

            {{-- お問い合わせの種類 --}}
            <input class="contact__item type="text" name="category" value="{{ $contact['category']['content'] }}" readonly />

          </td>
          <td class="record">

            {{-- 詳細ボタン --}}
            <input class="contact__detail-button" type="button" onclick="　　　　　" value="詳細">

          </td>
          <td class="record">

            {{-- contactsテーブルのidをAuthControllerに渡す --}}
            <input type="hidden" name="id" value="{{ $contact['id'] }}">
          </td>

        </tr>
        @endforeach

      </table>
    </div>
  </div>


        {{--  <td class="contact-table__item"> --}}
            {{-- DELETEメソッドで/contacts/deleteに送信する --}}
            {{--  <form class="delete-form" action="/contacts/delete" method="POST">
                @method('DELETE')
                @csrf --}}

                {{-- contactsテーブルのidをTodoControllerに渡す --}}
                {{-- <input type="hidden" name="id" value="{{ $contact['id'] }}">

                <div class="delete-form__button">
                    <button class="delete-form__button-submit" type="submit">削除</button>
                </div>
            </form>
        </td> --}}










</div>
@endsection
