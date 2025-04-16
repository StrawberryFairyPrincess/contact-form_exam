<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    @yield('css')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles --}}
</head>

<body>

    <header class="header">

        <div class="header__inner">

            <a class="header__logo" href="/">
                FashionablyLate
            </a>

            <nav>
                <ul class="header-nav">
                    <?php $path = $_SERVER['REQUEST_URI'];

                    if ( ( strpos($path, '/admin') !== false ) && Auth::check() ){ ?>
                        <li class="header-nav__item">
                            <form  class="header-nav__button" action="/logout" method="POST">
                                @csrf
                                <button type="submit">logout</button>
                            </form>
                        </li>
                    <?php } elseif( strpos($path, '/login') !== false ){ ?>
                        <li class="header-nav__item">
                            <form  class="header-nav__button" action="/register" method="GET">
                                @csrf
                                <button type="submit">register</button>
                            </form>
                        </li>
                    <?php }elseif( strpos($path, '/register') !== false ){ ?>
                        <li class="header-nav__item">
                            <form  class="header-nav__button" action="/login" method="GET">
                                @csrf
                                <button type="submit">login</button>
                            </form>
                        </li>
                    <?php } ?>

                </ul>
            </nav>

        </div>

    </header>

    <main>
        @yield('content')
    </main>

    {{-- @livewireScripts --}}
</body>

</html>
