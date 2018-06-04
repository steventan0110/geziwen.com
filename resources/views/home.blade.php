@extends('layouts.app')

@section('content')

    @if(Auth::user()->role == 'agency')

        <div class="container">

            <div class="row">
                @if (isset($mesasage))
                    <div class="alert alert-{{ $mesasge->type }}">
                        {{ $message->body }}
                    </div>
                @endif

                <div class="col-lg-4">
                    <div id="account" class="mb-4">
                        <div class="p-3 bg-white rounded box-shadow">
                            <h5 class="border-bottom border-gray pb-2 mb-2">账号信息</h5>
                            <dl class="row">
                                <dt class="col-sm-4">账号名称</dt>
                                <dd class="col-sm-8">{{ $user->agency->name }}</dd>
                                <dt class="col-sm-4">登录邮箱</dt>
                                <dd class="col-sm-8">{{ $user->email }}</dd>
                            </dl>
                            <button type="button" class="btn btn-danger btn-block" data-toggle="tooltip"
                                    data-placement="bottom" title="退出登录，点击忘记密码，接收邮件重置密码。">
                                修改密码
                            </button>
                        </div>
                    </div>
                    <div id="agency" class="mb-4">
                        <div class="p-3 bg-white rounded box-shadow">
                            <h5 class="border-bottom border-gray pb-2 mb-2">基本信息</h5>
                            <dl class="row">
                                <dt class="col-sm-4">机构名称</dt>
                                <dd class="col-sm-8">{{ $user->agency->name }}</dd>
                                <dt class="col-sm-4">机构简介</dt>
                                <dd class="col-sm-8">{{ $user->agency->introduction }}</dd>
                                <dt class="col-sm-4">地址</dt>
                                <dd class="col-sm-8">{{ $user->agency->address }}</dd>
                                <dt class="col-sm-4">联系电话</dt>
                                <dd class="col-sm-8">{{ $user->agency->telephone }}</dd>
                                <dt class="col-sm-4">网址</dt>
                                <dd class="col-sm-8">{{ $user->agency->website }}</dd>
                                <dt class="col-sm-4">邮箱地址</dt>
                                <dd class="col-sm-8">{{ $user->agency->email }}</dd>
                                <dt class="col-sm-4">开办日期</dt>
                                <dd class="col-sm-8">{{ $user->agency->started_on }}</dd>
                            </dl>
                            <a class="btn btn-warning btn-block" href="{{ route('agencies.edit', ['id' => $user->agency->id]) }}">编辑</a>
                            <a class="btn btn-info btn-block" href="{{ route('agencies.show', ['id' => $user->agency->id]) }}">查看主页效果</a>
                        </div>
                    </div>
                </div>
                <div id="applicants" class="col-lg-4 mb-4">
                    <div class="p-3 bg-white rounded box-shadow">
                        <h5 class="border-bottom border-gray pb-2 mb-0">部分案例</h5>
                        @foreach ($user->agency->applicants()->limit(5)->get() as $applicant)
                            @component('components.applicant', ['applicant' => $applicant])

                            @endcomponent
                        @endforeach
                        <small class="d-block text-right mt-3">
                            <a class="btn btn-block btn-warning" href="{{ route('agency.applicants.create', ['agency' => $user->agency->id ]) }}">创建新案例</a>
                            <a class="btn btn-block btn-info" href="{{ route('agency.applicants.index', ['id' => $user->agency->id]) }}">查看所有案例</a>
                        </small>
                    </div>
                </div>

            </div>

        </div>

    @elseif(Auth::user()->role == 'geziwen')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            You are logged in!
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
