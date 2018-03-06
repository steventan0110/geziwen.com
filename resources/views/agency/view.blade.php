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
            <div class="col-lg-8">
                TODO
            </div>
        </div>
    </div>

@endsection
