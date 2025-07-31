<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    @unless (Request::is('thanks'))
    <header class="header">
        <div class="header__inner">
            <div class="header-logo">
                <a href="/" class="header-logo__link-home">
                    FashionablyLate
                </a>
            </div>
            @yield('nav')
        </div>
    </header>
    @endunless
    <main>
    @yield('content')
    </main>
</body>
</html>