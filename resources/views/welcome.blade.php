<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>哥子稳成都留学信息平台</title>

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

</head>
<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white box-shadow">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" height="64px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="">主页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">博客</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">关于本站</a>
                    </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0 ml-2" action="{{ url('search') }}" method="post">
                    @csrf
                    <input class="form-control mr-sm-2" type="text" placeholder="机构/案例" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
                </form>
            </div>
        </nav>
    </header>

<main role="main">

    <div id="features" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#features" data-slide-to="0" class="active"></li>
            <li data-target="#features" data-slide-to="1"></li>
            <li data-target="#features" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="{{ asset('images/chengdu-1.jpg') }}" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>留学机构平台</h1>
                        <p>我们已经为成都的学生和家长打造了一套成都留学机构和语言培训机构信息共享平台。我们通过邀请各大机构进驻，用标准形式展示他们的服务、案例、师资，帮助学生和家长精准匹配适合他们的机构。</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('agencies.index') }}" role="button">所有机构</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="{{ asset('images/chengdu-2.jpg') }}" alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-center">
                        <h1>成都留学信息</h1>
                        <p>我们邀请成都在国外留学的学长学姐通过推文分享他们的故事，包括他们的大学生活、申请经历和备考经验。我们成功与ACULAC举办第一次线下活动，致力于打破成都一些家长和学生对文理学院的刻板印象。</p>
                        <p><a class="btn btn-lg btn-warning" target="_blank" href="http://blog.geziwen.com" role="button">前往博客</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide" src="{{ asset('images/chengdu-3.jpg') }}" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>学生活动平台.</h1>
                        <p>我们的开发团队正在为成都各大社团打造一套活动组织平台。我们致力于帮助成都的学生更快找到适合他们的活动，并通过我们在成都留学圈的影响力帮助活动的组织者扩大他们的影响力。</p>
                        <p><a class="btn btn-lg btn-info disabled" target="_blank" href="http://activity.geziwen.com" role="button">立即注册</a></p>
                    </div>
                </div>
            </div>

        </div>
        <a class="carousel-control-prev" href="#features" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#features" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- START THE FEATURETTES -->

        {{--<hr class="featurette-divider">--}}

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">信任：<span class="text-muted">信息经过审核</span></h2>
                <p class="lead">对于每一家入驻我们平台的公司，我们都对其提供的案例信息和师资信息进行审核，以确保我们平台信息的真实性。<a href="{{ route('agencies.index') }}">点击查看所有机构</a></p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="{{ asset('images/feature-1.jpg') }}" data-holder-rendered="true" width="500px">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">全面：<span class="text-muted">师资 案例 服务</span></h2>
                <p class="lead">每一家入住的机构都对应有一个主页，哥子稳团队作为申请季的过来人，在案例展示、服务流程展示和师资展示环节，保证给学生和家长提供最精简和必要的信息。<a href="{{ route('agencies.index') }}">点击查看所有机构</a></p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="featurette-image img-fluid mx-auto" src="{{ asset('images/feature-2.png') }}" data-holder-rendered="true" width="500px">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">专注： <span class="text-muted">仅面对成都地区</span></h2>
                <p class="lead">我们走过一年多的路程，仍不忘我们成立时的初衷，即致力于服务成都地区有留学意向的学生和家长。<a href="{{ route('agencies.index') }}">点击查看所有机构</a></p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="{{ asset('images/feature-3.png') }}" data-holder-rendered="true" width="500px">
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"><a href="#">回到顶部</a></p>
        <p>© 2017-2018 哥子稳</p>
    </footer>
</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

    <script src="{{ asset('js/landing.js') }}"></script>

</body>
</html>
