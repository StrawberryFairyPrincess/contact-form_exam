<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>

    <header class="header">

        <div class="header__inner">
            {{-- <div class="header-utilities"> --}}

                <a class="header__logo" href="/">
                    FashionablyLate
                </a>

            {{-- </div> --}}


            <nav>
                <ul class="header-nav">

                    @if(Auth::check())
                        <li class="header-nav__item">
                            <form  class="header-nav__button" action="/logout" method="POST">
                                @csrf
                                <button type="submit">logout</button>
                            </form>
                        </li>
                    {{-- @else
                        @if()
                            <li class="header-nav__item">
                                <form  class="header-nav__button" action="/register" method="POST">
                                    @csrf
                                    <button type="submit">register</button>
                                </form>
                            </li>
                        @elseif()
                            <li class="header-nav__item">
                                <form  class="header-nav__button" action="/login" method="POST">
                                    @csrf
                                    <button type="submit">login</button>
                                </form>
                            </li>
                        @endif --}}
                    @endif
                </ul>
            </nav>

        </div>

    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>
