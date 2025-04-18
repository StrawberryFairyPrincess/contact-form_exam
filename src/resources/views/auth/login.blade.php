@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="login-form__content">

  <div class="login-form__heading">
    <h2>Login</h2>
  </div>

  <div class="form__flex">
    <div class="form__style">
      <form class="form" action="/login" method="POST">
        @csrf

        <div class="form__group">

          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
          </div>

          <div class="form__group-content">

            <div class="form__input--text">
              <input type="email" name="email" value="{{ old('email') }}"  placeholder="例: test@example.com" />
            </div>

            <div class="form__error">
              @error('email')
                メールアドレスを入力してください
              @enderror
            </div>

          </div>

        </div>

        <div class="form__group">

          <div class="form__group-title">
            <span class="form__label--item">パスワード</span>
          </div>

          <div class="form__group-content">

            <div class="form__input--text">
              <input type="password" name="password" placeholder="例: coachtech1106" />
            </div>

            <div class="form__error">
              @error('password')
                パスワードを入力してください
              @enderror
            </div>

          </div>

        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit">ログイン</button>
        </div>

      </form>
    </div>
  </div>

</div>
@endsection
