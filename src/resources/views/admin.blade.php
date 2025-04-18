@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
{{-- @vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles --}}
@endsection

@section('content')

  <div class="admin__heading">
    <h2>Admin</h2>
  </div>

  <div class="admin__content">
    <div class="admin__search">

      <form class="search-form" action="/search" method="GET">
        @csrf
        <div class="form__style">

          {{-- キーワード検索 --}}
          <div class="form-flex-arrow">
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください ">
          </div>

          {{-- 性別検索 --}}
          <div class="form-flex-arrow">
            <div class="form-box-arrow">
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
          <div class="form-flex-arrow">
            <div class="form-box-arrow">
              <select class="search-form__item-select" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                  <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- 作成日検索 --}}
          <div class="form-flex-arrow">
            <div class="form-box-arrow">
              <input class="search-form__item-date" type="date" name="created_at" value="{{ old('created_at') }}">
            </div>
          </div>

          {{-- 検索ボタン --}}
          <div class="form-flex-arrow">
            <button class="search-form__button-submit" type="submit">検索</button>
          </div>

          {{-- リセットボタン --}}
          <div class="form-flex-arrow">
            <input class="search-form__button-reset" type="button" onclick="location.href='/admin'" value="リセット">
          </div>

        </div>
      </form>

      <div class="form__style">

        {{-- CSVダウンロードボタン --}}
        <div class="button-export">
          <button id="download">エクスポート</button>
          <script>
            'use strict'
            document.getElementById('download')
            .addEventListener('click', () => {
                fetch('/api/contactExport', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content,
                        'Content-Type': 'application/json'
                        },
                })
                .then(response => response.blob().then(blob => {
                    let link = document.createElement('a')
                    link.href = window.URL.createObjectURL(blob)
                    link.download = 'contacts.csv'
                    link.click()
                }))
            })
          </script>
        </div>

        {{-- ページネーションボタン --}}
        <div class="button-paginate">
              @foreach( $contacts as $contact )
                {{ $contact->title }}
              @endforeach
            {{ $contacts->links('vendor.pagination.default') }}
        </div>

      </div>

    </div>

    {{-- お問い合わせリスト --}}
    <div class="contact-table">
      <table class="contact-table__inner">

        <tr class="contact-table__row">
          <th class="contact-table__header">
            <span class="name">お名前</span>
          </th>
          <th class="contact-table__header">
            <span class="gender">性別</span>
          </th>
          <th class="contact-table__header">
            <span class="email">メールアドレス</span>
          </th>
          <th class="contact-table__header">
            <span class="category">お問い合わせの種類</span>
          </th>
          <th class="contact-table__header"></th>
        </tr>

        {{-- AuthControllerで取得したcontactsテーブルのひとつの内容contentを表示 --}}
        @foreach($contacts as $contact)

        <tr class="contact-table__row">

          {{-- お名前 --}}
          <td class="contact-table__data">
            <span>{{ $contact['last-name'] . '　' . $contact['first-name'] }}</span>
          </td>

          {{-- 性別 --}}
          <td class="contact-table__data">
            @if( $contact['gender'] == 1 )
                <span>男性</span>
            @elseif( $contact['gender'] == 2 )
                <span>女性</span>
            @elseif( $contact['gender'] == 3 )
                <span>その他</span>
            @endif
          </td>

          {{-- メールアドレス --}}
          <td class="contact-table__data">
            <span>{{ $contact['email'] }}</span>
          </td>

          {{-- お問い合わせの種類 --}}
          <td class="contact-table__data">
            <span>{{ $contact['category']['content'] }}</span>
          </td>

          {{-- 詳細ボタン --}}
          <td class="contact-table__data">

            <div class="detail-button">

              {{-- @if( $loop->iteration % 1 == 0 )
                <button class="contact__detail-button" popovertarget="popover-1" type="button">詳細</button>
              @elseif( $loop->iteration % 2 == 0 )
                <button class="contact__detail-button" popovertarget="popover-2" type="button">詳細</button>
              @elseif( $loop->iteration % 3 == 0 )
                <button class="contact__detail-button" popovertarget="popover-3" type="button">詳細</button>
              @elseif( $loop->iteration % 4 == 0 )
                <button class="contact__detail-button" popovertarget="popover-4" type="button">詳細</button>
              @elseif( $loop->iteration % 5 == 0 )
                <button class="contact__detail-button" popovertarget="popover-5" type="button">詳細</button>
              @elseif( $loop->iteration % 6 == 0 )
                <button class="contact__detail-button" popovertarget="popover-6" type="button">詳細</button>
              @elseif( $loop->iteration % 7 == 0 )
                <button class="contact__detail-button" popovertarget="popover-7" type="button">詳細</button>
              @endif --}}

              <button class="contact__detail-button" popovertarget="<?= 'modal-' . $loop->iteration ?>" type="button">詳細</button>

            </div>

            {{-- モーダルウィンドウ --}}

            {{-- @if( $loop->iteration % 1 == 0 )
              <div class="modal" id="popover-1" popover="manual" popover>
                <button class="close" popovertarget="popover-1" popovertargetaction="hide" type="button">×</button>
            @elseif( $loop->iteration % 2 == 0 )
              <div class="modal" id="popover-2" popover="manual" popover>
                <button class="close" popovertarget="popover-2" popovertargetaction="hide" type="button">×</button>
            @elseif( $loop->iteration % 3 == 0 )
              <div class="modal" id="popover-3" popover="manual" popover>
                <button class="close" popovertarget="popover-3" popovertargetaction="hide" type="button">×</button>
            @elseif( $loop->iteration % 4 == 0 )
              <div class="modal" id="popover-4" popover="manual" popover>
                <button class="close" popovertarget="popover-4" popovertargetaction="hide" type="button">×</button>
            @elseif( $loop->iteration % 5 == 0 )
              <div class="modal" id="popover-5" popover="manual" popover>
                <button class="close" popovertarget="popover-5" popovertargetaction="hide" type="button">×</button>
            @elseif( $loop->iteration % 6 == 0 )
              <div class="modal" id="popover-6" popover="manual" popover>
                <button class="close" popovertarget="popover-6" popovertargetaction="hide" type="button">×</button>
            @elseif( $loop->iteration % 7 == 0 )
              <div class="modal" id="popover-7" popover="manual" popover>
                <button class="close" popovertarget="popover-7" popovertargetaction="hide" type="button">×</button>
            @endif --}}

            <div class="modal" id="<?= 'modal-' . $loop->iteration ?>" popover="manual" popover>
              <button class="close" popovertarget="<?= 'modal-' . $loop->iteration ?>" popovertargetaction="hide" type="button">×</button>

              <div class="detail-table">
                <table class="detail-table__inner">

                  <tr class="detail-table__row">
                    <th class="detail-table__header">お名前</th>
                    <td class="detail-table__text">
                      <span>{{ $contact['last-name'] . '　' . $contact['first-name'] }}</span>
                    </td>
                  </tr>

                  <tr class="detail-table__row">
                    <th class="detail-table__header">性別</th>
                    <td class="detail-table__text">
                      @if( $contact['gender'] == 1 )
                        <span>男性</span>
                      @elseif( $contact['gender'] == 2 )
                        <span>女性</span>
                      @elseif( $contact['gender'] == 3 )
                        <span>その他</span>
                      @endif
                    </td>
                  </tr>

                  <tr class="detail-table__row">
                    <th class="detail-table__header">メールアドレス</th>
                    <td class="detail-table__text">
                      <span>{{ $contact['email'] }}</span>
                    </td>
                  </tr>

                  <tr class="detail-table__row">
                    <th class="detail-table__header">電話番号</th>
                    <td class="detail-table__text">
                      <span>{{ $contact['tel'] }}</span>
                    </td>
                  </tr>

                  <tr class="detail-table__row">
                    <th class="detail-table__header">住所</th>
                    <td class="detail-table__text">
                      <span>{{ $contact['address'] }}</span>
                    </td>
                  </tr>

                  <tr class="detail-table__row">
                    <th class="detail-table__header">建物名</th>
                    <td class="detail-table__text">
                      <span>{{ $contact['building'] }}</span>
                    </td>
                  </tr>

                  <tr class="detail-table__row">
                    <th class="detail-table__header">お問い合わせの種類</th>
                    <td class="detail-table__text">
                      <span>{{ $contact['category']['content'] }}</span>
                    </td>
                  </tr>

                  <tr class="detail-table__row">
                    <th class="detail-table__header">お問い合わせ内容</th>
                    <td class="detail-table__text">
                      <span>{{ $contact['detail'] }}</span>
                    </td>
                  </tr>

                </table>
              </div>

              <div class="delete-form__button">

                {{-- DELETEメソッドで/deleteに送信する --}}
                <form class="form" action="/delete" method="POST">
                  @method('DELETE')
                  @csrf

                  {{-- contactsテーブルのidをAuthControllerに渡す --}}
                  <input type="hidden" name="id" value="{{ $contact['id'] }}">

                  <button class="delete-form__button-submit" type="submit">削除</button>

                </form>

              </div>

            </div>

          </td>
        </tr>

        @endforeach

      </table>
    </div>
  </div>



















</div>
@endsection
