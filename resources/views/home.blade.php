@extends('layouts.app')

@section('content')

    @if(Auth::user()->role == 'agency')
    <div class="container">
        @include('teacher.messages')
    </div>
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
                <div id="applicants" class="col-lg-8 mb-4">
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


                    <div class="p-3 mt-3 bg-white rounded box-shadow">
                        <h5 class="border-bottom border-gray pb-2 mb-0">师资</h5>
                            <div class="row">
                                @foreach($user->agency->teachers()->limit(6)->get() as $teacher)
                                    @component('components.teacher',['agency'=>$user->agency,'teacher'=>$teacher])

                                    @endcomponent

                                @endforeach
                                <hr>
                            </div>
                        <div class="mt-3">
                            <a class="btn btn-md btn-warning btn-block "  href="{{route('agency.teachers.create',['agency_id'=>$teacher->agency->id,'teacher_id'=>$teacher->id])}}">添加老师</a>
                            <a class="btn btn-md btn-info btn-block"  href="{{route('agency.teachers.index',['agency_id'=>$teacher->agency->id])}}">查看所有</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif(Auth::user()->role == 'geziwen')
        <div class="container">
        <div class="row">
        <div class="col-lg-4">
            <div id="account" class="mb-4">
                <div class="p-3 bg-white rounded box-shadow">
                    <h5 class="border-bottom border-gray pb-2 mb-2">账号信息</h5>
                    <dl class="row">
                        <dt class="col-sm-4">账号名称</dt>
                        <dd class="col-sm-8">{{ $user->name }}</dd>
                        @if ($user->email != null)
                            <dt class="col-sm-4">用户邮箱</dt>
                            <dd class="col-sm-8">{{ $user->email }}</dd>
                        @else
                            <dt class="col-sm-4">用户手机</dt>
                            <dd class="col-sm-8">{{ $user->mobile }}</dd>
                        @endif

                    </dl>
                    <button type="button" class="btn btn-danger btn-block" data-toggle="tooltip">
                        修改密码
                    </button>
                </div>
            </div>
        </div>

    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="p-3 bg-white rounded box-shadow">
                <h5 class="border-bottom border-gray pb-2 mb-0">邀请机构</h5>
                @foreach($user->agencies as $agency)
                <div class="media pt-3">
                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <div class="row">
                            <div class="col-md-8">
                                <strong class="d-block text-gray-dark">{{ $agency->name }}</strong>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-info btn-sm float-right ml-2" href="{{route('agencies.show',[$agency->id])}}">查看详细</a>
                                @can('update', $agency)
                                    <a class="btn btn-warning btn-sm  float-right" href="{{route('agencies.edit',[$agency->id])}}">编辑</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @can('create')
                    <a class="btn btn-block btn-md btn-info mt-3" href="{{route('agencies.create')}}">添加机构</a>
                @endcan
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
