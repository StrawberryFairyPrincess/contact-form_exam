@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
    <div class="contact-form__content">

        <div class="contact-form__heading">
            <h2>Contact</h2>
        </div>

        {{-- POSTメソッドで/confirmに送信する --}}
        <form class="form" action="/confirm" method="post">
            @csrf

            <div class="form__group">

                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>

                <div class="form__group-content">

                    <div class="form__input--text">
                        <div class="form__input--text__flex">

                            <div class="form__input--text__box">
                                <input type="text" name="last-name" placeholder="例: 山田" value="{{ old('last-name') }}" />
                            </div>

                            <div class="form__input--text__box">
                                <input type="text" name="first-name" placeholder="例: 太郎" value="{{ old('first-name') }}" />
                            </div>

                        </div>
                    </div>

                    {{-- バリデーションエラーメッセージ --}}
                    <div class="form__error">
                        @error('last-name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__error">
                        @error('first-name')
                            {{ $message }}
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form__group">

                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>

                <div class="form__group-content">

                    <div class="form__input--radio">
                        <label class="form__input--radio-label">
                            <input class="form__input--radio-button" type="radio" name="gender" value="男性" checked {{ old('gender') == "男性" ? 'checked' : '' }}>
                            <span class="form__input--radio-text">男性</span>
                        </label>
                        <label class="form__input--radio-label">
                            <input class="form__input--radio-button" type="radio" name="gender" value="女性" {{ old('gender') == "女性" ? 'checked' : '' }}>
                            <span class="form__input--radio-text">女性</span>
                        </label>
                        <label class="form__input--radio-label">
                            <input class="form__input--radio-button" type="radio" name="gender" value="その他" {{ old('gender') == "その他" ? 'checked' : '' }}>
                            <span class="form__input--radio-text">その他</span>
                        </label>
                    </div>

                    {{-- バリデーションエラーメッセージ --}}
                    <div class="form__error">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form__group">

                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>

                <div class="form__group-content">

                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
                    </div>

                    {{-- バリデーションエラーメッセージ --}}
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form__group">

                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>

                <div class="form__group-content">

                    <div class="form__input--text">
                        <div class="form__input--text__flex">

                            <div class="form__input--text__box">
                                <input type="tel" name="tel-area" placeholder="080" value="{{ old('tel-area') }}" />
                            </div>

                            <span>-</span>

                            <div class="form__input--text__box">
                                <input type="tel" name="tel-city" placeholder="1234" value="{{ old('tel-city') }}" />
                            </div>

                            <span>-</span>

                            <div class="form__input--text__box">
                                <input type="tel" name="tel-subscriber" placeholder="5678" value="{{ old('tel-subscriber') }}" />
                            </div>

                        </div>
                    </div>

                    {{-- バリデーションエラーメッセージ --}}
                    <?php
                        $area = null;
                        $city = null;
                    ?>
                    <div class="form__error">
                        @error('tel-area')
                            {{ $message }}
                            <?php $area = $message; ?>
                        @enderror
                    </div>
                    <div class="form__error">
                        @error('tel-city')
                            @if( $message != $area )
                                {{ $message }}
                            @endif
                            <?php $city = $message; ?>
                        @enderror
                    </div>
                    <div class="form__error">
                        @error('tel-subscriber')
                            @if( $message != $area && $message != $city )
                                {{ $message }}
                            @endif
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form__group">

                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>

                <div class="form__group-content">

                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                    </div>

                    {{-- バリデーションエラーメッセージ --}}
                    <div class="form__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form__group">

                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>

                <div class="form__group-content">

                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}" />
                    </div>

                </div>

            </div>

            <div class="form__group">

                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>

                <div class="form__group-content">

                    <div class="form__input--select-flex">
                        <div class="form__input--select-box">

                            <select name="category_id">

                                <option value="" selected>選択してください</option>

                                @foreach($categories as $category)
                                    {{-- categoriesテーブルのidをTodoControllerに渡す --}}
                                    <option value="{{ $category['id'] }}" @if( old('category_id') == $category['id'] ) selected @endif>
                                        {{ $category['content'] }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    {{-- バリデーションエラーメッセージ --}}
                    <div class="form__error">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>

                </div>

            </div>

            <div class="form__group-contact">

                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>

                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    </div>

                    {{-- バリデーションエラーメッセージ --}}
                    <div class="form__error">
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>

        </form>

    </div>
@endsection