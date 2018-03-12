@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">中介信息</div>
                    <img class="card-img-top"
                         alt="Card image cap"
                         src="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=2702838711,917269472&fm=27&gp=0.jpg"/>
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
            <div class="col-lg-8">
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">申请情况</div>
                    <ul class="list-group list-group-flush">
                        @foreach($applications as $application)
                            <li class="list-group-item">
                                学校：<a href="{{ $application->university['website'] }}">{{ $application->university['name'] }}</a>
                                Plan: {{ $application->plan['shorthand'] }} ({{ $application->plan['name'] }})
                                结果：{{ $application->decision['name'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">基本信息</div>
                    <div class="card-body row">
                        <div class="col-sm-8">
                            <h5 class="card-title">{{ $profile['name'] }}</h5>
                            <p class="card-text">{{ $profile['introduction'] }}</p>
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
                            @if(count($tests['toefls']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#toefl" data-toggle="tab">TOEFL</a>
                                </li>
                            @endif
                            @if(count($tests['ieltss']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#ielts" data-toggle="tab">IELTS</a>
                                </li>
                            @endif
                            @if(count($tests['sats']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#sat" data-toggle="tab">SAT</a>
                                </li>
                            @endif
                            @if(count($tests['satSubjects']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#satii" data-toggle="tab">SAT II</a>
                                </li>
                            @endif
                            @if(count($tests['aps']))
                                <li class="nav-item">
                                    <a class="nav-link" href="#ap" data-toggle="tab">AP</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane fade active show" id="test-summary">
                            <dl class="row">
                                @if(count($tests['toefls']))
                                    <dt class="col-sm-3">TOEFL</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            {{--TODO: Implement in server side--}}
                                            <dt class="col-sm-4">最高总分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">最高拼分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">考试次数</dt>
                                            <dd class="col-sm-8">{{ count($tests['toefls']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['ieltss']))
                                    <dt class="col-sm-3">IELTS</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            {{--TODO: Implement in server side--}}
                                            <dt class="col-sm-4">最高总分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">最高拼分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">考试次数</dt>
                                            <dd class="col-sm-8">{{ count($tests['ieltss']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['sats']))
                                    <dt class="col-sm-3">SAT</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            {{--TODO: Implement in server side--}}
                                            <dt class="col-sm-4">最高总分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">最高拼分</dt>
                                            <dd class="col-sm-8">TODO</dd>
                                            <dt class="col-sm-4">考试次数</dt>
                                            <dd class="col-sm-8">{{ count($tests['sats']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['satSubjects']))
                                    <dt class="col-sm-3">SAT II</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            <dt class="col-sm-4">科目数量</dt>
                                            <dd class="col-sm-8">{{ count($tests['satSubjects']) }}</dd>
                                        </dl>
                                    </dd>
                                @endif
                                @if(count($tests['aps']))
                                    <dt class="col-sm-3">AP</dt>
                                    <dd class="col-sm-9">
                                        <dl class="row">
                                            <dt class="col-sm-4">科目数量</dt>
                                            <dd class="col-sm-8">{{ count($tests['aps']) }}</dd>
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
                                @foreach($tests['toefls'] as $test)
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
                                @foreach($tests['ieltss'] as $test)
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
                                @foreach($tests['sats'] as $test)
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
                                @foreach($tests['satSubjects'] as $test)
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
                                @foreach($tests['aps'] as $test)
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
                        <dl class="row">
                            @foreach($activities as $activity)
                                <!--Basic Activity Overview-->
                                <dt class="col-sm-3">
                                    <p>{{ $activity['name'] }}</p>
                                </dt>
                                <dd class="col-sm-6">{{ $activity['description'] }}</dd>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#activity-{{ $activity['id'] }}">查看详细</button>
                                </div>
                                <!--Detailed Activity View through Modals-->
                                <div class="modal fade" id="activity-{{ $activity['id'] }}" tabindex="-1" role="dialog" aria-labelledby="activity-{{ $activity['id'] }}-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="activity-{{ $activity['id'] }}-label">活动详情</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card" style="margin-bottom: 1rem!important;">
                                                    <div class="card-header">{{ $activity['name'] }}</div>
                                                    <div class="card-body">
                                                        <p class="card-text">{{ $activity['description'] }}</p>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">活动类别：{{ $activity['type']['name'] }}</li>
                                                        <li class="list-group-item">开始日期：{{ $activity['start'] }}</li>
                                                        <li class="list-group-item">结束日期：{{ $activity['end'] }}</li>
                                                        <li class="list-group-item">每周投入时间：{{ $activity['hours_per_week'] }}小时</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 1rem!important;">
                    <div class="card-header">奖项</div>
                    <div class="card-body">
                        <dl class="row">
                            @foreach($awards as $award)
                                <!--Basic Activity Overview-->
                                <dt class="col-sm-3">
                                    {{ $award['name'] }} {{ $award['received_on'] }}
                                </dt>
                                <dd class="col-sm-9">{{ $award['description'] }}</dd>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
