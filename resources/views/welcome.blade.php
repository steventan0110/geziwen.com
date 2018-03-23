<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>哥子稳--成都留学</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    </head>
    <body class="text-center">
        {{--<div class="flex-center position-ref full-height">--}}

        {{--</div>--}}

        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                    <h3 class="masthead-brand">
                        Geziwen
                    </h3>
                    <nav class="nav nav-masthead justify-content-center">
                        {{--<a class="nav-link active" href="https://getbootstrap.com/docs/4.0/examples/cover/#">Home</a>--}}
                        {{--<a class="nav-link" href="https://getbootstrap.com/docs/4.0/examples/cover/#">Features</a>--}}
                        {{--<a class="nav-link" href="https://getbootstrap.com/docs/4.0/examples/cover/#">Contact</a>--}}
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link" href="{{ route('home') }}">个人主页</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">登陆</a>
                                <a class="nav-link" href="{{ route('register') }}">注册</a>
                            @endauth
                        @endif
                    </nav>
                </div>
            </header>

            <main role="main" class="inner cover">
                <h1 class="cover-heading">哥子稳留学信息平台</h1>
                <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
                <form action="{{-- Search --}}" class="justify-content-center">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" name="q" class="form-control mb-2" id="search-keyword" placeholder="留学机构、案例">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary btn-block">搜索</button>
                        </div>
                    </div>
                </form>
            </main>

            <footer class="mastfoot mt-auto">
                <div class="inner">
                    <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                </div>
            </footer>
        </div>
        <script src="{{ asset('js/landing.js') }}"></script>
    </body>
</html>
