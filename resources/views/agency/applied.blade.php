@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 资料提交成功
@endsection

@section('content')

    <div id="agency" class="container">
        <div class="bg-white box-shadow jumbotron">
            <h1 class="display-4">申请已提交</h1>
            <p class="lead">来自{{ $agency->name }}的老师们好，我们已经收到您入驻的基本资料。在接下来的48小时内，哥子稳团队会审核和确认你们提供的信息，我们将在审核通过后与您取得联系。</p>
            <hr class="my-4">
            <p>工作之余，您不妨暂时放下手中的忙碌，点击下方的链接访问我们的主页，查看我们团队成立一年多以来的历程。</p>
            <p class="lead">
                <a class="btn btn-link btn-lg" href="/" role="button">geziwen.com</a>
            </p>
        </div>
    </div>

@endsection
