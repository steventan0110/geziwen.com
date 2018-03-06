@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">中介信息</div>
                    <img class="card-img-top"
                         alt="Card image cap"
                         src="https://i2.wp.com/zehaohuang.cn/wp-content/uploads/2017/12/stanford.jpeg?w=1680"/>
                    <div class="card-body">
                        <h5 class="card-title">{{ $agency['name'] }}</h5>
                        <p class="card-text">{{ $agency['introduction'] }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">地址：{{ $agency['address'] }}</li>
                        <li class="list-group-item">联系电话：{{ $agency['telephone'] }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ $agency['website'] }}" class="card-link">访问官网</a>
                        <a href="mailto:{{ $agency['email'] }}" class="card-link">写邮件</a>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">基本信息</div>
                    <div class="card-body row">
                        <div class="col-sm-8">
                            <h5 class="card-title">{{ $profile['name'] }}</h5>
                            <p class="card-text">{{ $profile['introduction'] }}</p>
                        </div>
                        <div class="col-sm">
                            <img src="https://i1.wp.com/zehaohuang.cn/wp-content/uploads/2018/02/img_5a7c987ce8a56.jpeg?w=1680"
                                 class="rounded img-fluid"/>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#test-summary" data-toggle="tab">概况</a>
                            </li>
                            @if(count($tests['toefl']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#toefl" data-toggle="tab">TOEFL</a>
                                </li>
                            @endif
                            @if(count($tests['ielts']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#ielts" data-toggle="tab">IELTS</a>
                                </li>
                            @endif
                            @if(count($tests['sat']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#sat" data-toggle="tab">SAT</a>
                                </li>
                            @endif
                            @if(count($tests['satSubject']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#satii" data-toggle="tab">SAT II</a>
                                </li>
                            @endif
                            @if(count($tests['ap']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#ap" data-toggle="tab">AP</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane fade active show" id="test-summary">
                            <dl class="row">
                                @if(count($tests['toefl']))
                                    <dt class="col-sm-3">TOEFL</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            {{--TODO: Implement in server side--}}
                                            <dt class="col-sm-4">最高总分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">最高拼分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">考试次数</dt>
                                            <dd class="col-sm-8">{{ count($tests['toefl']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['ielts']))
                                    <dt class="col-sm-3">IELTS</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            {{--TODO: Implement in server side--}}
                                            <dt class="col-sm-4">最高总分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">最高拼分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">考试次数</dt>
                                            <dd class="col-sm-8">{{ count($tests['ielts']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['sat']))
                                    <dt class="col-sm-3">SAT</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            {{--TODO: Implement in server side--}}
                                            <dt class="col-sm-4">最高总分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">最高拼分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">考试次数</dt>
                                            <dd class="col-sm-8">{{ count($tests['sat']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['satSubject']))
                                    <dt class="col-sm-3">SAT II</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            <dt class="col-sm-4">科目数量</dt>
                                            <dd class="col-sm-8">{{ count($tests['satSubject']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['ap']))
                                    <dt class="col-sm-3">AP</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            <dt class="col-sm-4">科目数量</dt>
                                            <dd class="col-sm-8">{{ count($tests['ap']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                            </dl>
                        </div>
                        <div class="tab-pane fade" id="toefl">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">日期</th>
                                    <th scope="col">阅读</th>
                                    <th scope="col">听力</th>
                                    <th scope="col">口语</th>
                                    <th scope="col">写作</th>
                                    <th scope="col">总分</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tests['toefl'] as $test)
                                    <tr>
                                        <th scope="row">{{ $test['taken_on'] }}</th>
                                        <td>{{ $test['reading'] }}</td>
                                        <td>{{ $test['listening'] }}</td>
                                        <td>{{ $test['speaking'] }}</td>
                                        <td>{{ $test['writing'] }}</td>
                                        <td>{{ $test['reading'] + $test['listening'] + $test['speaking'] + $test['writing']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="ielts">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">日期</th>
                                    <th scope="col">阅读</th>
                                    <th scope="col">听力</th>
                                    <th scope="col">口语</th>
                                    <th scope="col">写作</th>
                                    <th scope="col">总分</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tests['ielts'] as $test)
                                    <tr>
                                        <th scope="row">{{ $test['taken_on'] }}</th>
                                        <td>{{ $test['reading'] / 2.0 }}</td>
                                        <td>{{ $test['listening'] / 2.0}}</td>
                                        <td>{{ $test['speaking'] / 2.0}}</td>
                                        <td>{{ $test['writing'] / 2.0}}</td>
                                        <td>{{ ($test['reading'] + $test['listening'] + $test['speaking'] + $test['writing']) / 2.0 }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="sat">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">日期</th>
                                    <th scope="col">阅读</th>
                                    <th scope="col">数学</th>
                                    <th scope="col">语法</th>
                                    <th scope="col">总分</th>
                                    <th scope="col">Essay</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tests['sat'] as $test)
                                    <tr>
                                        <th scope="row">{{ $test['taken_on'] }}</th>
                                        <td>{{ $test['reading'] }}</td>
                                        <td>{{ $test['math'] }}</td>
                                        <td>{{ $test['writing'] }}</td>
                                        <td>{{ $test['reading'] + $test['math'] + $test['writing'] }}</td>
                                        <td>{{ $test['essay'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="satii">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">日期</th>
                                    <th scope="col">科目</th>
                                    <th scope="col">分数</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tests['satSubject'] as $test)
                                    <tr>
                                        <th scope="row">{{ $test['taken_on'] }}</th>
                                        <td>{{ $test['subject'] }}</td>
                                        <td>{{ $test['score'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="ap">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">日期</th>
                                    <th scope="col">科目</th>
                                    <th scope="col">分数</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tests['ap'] as $test)
                                    <tr>
                                        <th scope="row">{{ $test['taken_on'] }}</th>
                                        <td>{{ $test['subject'] }}</td>
                                        <td>{{ $test['score'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">活动</div>
                    <div class="card-body">
                        {{--TODO: Implement this--}}
                    </div>
                </div>
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">奖项</div>
                    <div class="card-body"></div>
                    {{--TODO: Implement this--}}
                </div>
            </div>
        </div>
    </div>

@endsection
