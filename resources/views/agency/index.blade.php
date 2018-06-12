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
                        <img class="card-img-top" src="{{ Storage::exists('agency-'.$agency->id) ? asset('/storage/app/agency-'.$agency->id.'/photo.jpg') : asset('/storage/app/default.jpg') }}" alt="logo">
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
