@extends('layouts.app')

@section('title')
    哥子稳 | 所有入驻机构
@endsection


@section('content')
    <section class="jumbotron text-center bg-white">
        <div class="container">
            <h1 class="jumbotron-heading">入驻机构一览</h1>
            @if(Auth::check()==false)
            <p class="lead text-muted">注册成为用户，即可查看过来人对各个机构、服务和老师的评价。我们对每一条评论进行了严格审核，确保各位学生和家长访问到最准确的信息，并理性选择适合自己的机构。</p>
            <p>
                <a href="{{ route('register') }}" class="btn btn-primary my-2">注册</a>
                <a href="{{ route('login') }}" class="btn btn-secondary my-2">登录</a>
            </p>
            @endif
        </div>
    </section>
    <div class="container">
        <div class="row">
            @foreach($agencies as $agency)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22399%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20399%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16381e42e02%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A20pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16381e42e02%22%3E%3Crect%20width%3D%22399%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22132.109375%22%20y%3D%22121.35%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="logo">
                        <div class="card-body">
                            <h5>{{ $agency->name }}</h5>
                            <p class="card-text">{{ $agency->introduction }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('agency.show', ['id' => $agency->id]) }}" class="btn btn-sm btn-outline-primary">主页</a>
                                    <a href="{{ route('agency.applicant.index', ['id' => $agency->id]) }}" class="btn btn-sm btn-outline-primary">案例</a>
                                </div>
                                <small class="text-muted">始于：{{ $agency->started_on }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
