@extends('layouts.app')

@section('title')
    新机构入驻
@endsection

@section('content')

    <div id="agency" class="container">
        <form action="{{ route('agency.store') }}" method="post" class="bg-white box-shadow jumbotron">
            {{ csrf_field() }}
            @method('POST')
            <h2>基本信息</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h4 class="alert-heading">抱歉，出错了！</h4>
                    <p>您提交的表单中有部分信息不符合我们的要求，具体问题如下，麻烦修改，谢谢。</p>
                    <hr>
                    @foreach ($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="name">机构名称</label>
                <input type="text" class="form-control" id="name" name="agency[name]">
            </div>
            <div class="form-group mb-3">
                <label for="email">邮箱地址</label>
                <input type="email" class="form-control" id="email" name="agency[email]">
            </div>
            <div class="form-group mb-3">
                <label for="type">机构类别</label>
                <div class="input-group mb-3">
                    <select class="custom-select" id="type" name="agency[type]">
                        <option value="standard" selected>中介机构</option>
                        <option value="language">语言培训机构</option>
                    </select>
                </div>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-info btn-block">邀请</button>
            </div>
        </form>
    </div>

@endsection
