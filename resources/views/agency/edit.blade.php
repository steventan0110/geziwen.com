@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 编辑信息
@endsection

@section('content')

    <div id="agency" class="container">
        <form action="{{ route('agency.update', ['id' => $agency->id]) }}" method="post" class="bg-white box-shadow jumbotron" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <h5 class="border-bottom border-gray pb-2 mb-2">编辑基本信息</h5>
            @if($errors->any())
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
                <label for="name">机构名称 <span class="text-danger">必填</span></label>
                <input type="text" class="form-control" id="name" name="agency[name]" value="{{ $agency->name }}">
            </div>
            <div class="form-group mb-3">
                <label for="introduction">机构简介 <span class="text-danger">必填</span></label>
                <textarea class="form-control" id="introduction" name="agency[introduction]">{{ $agency->introduction }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="address">地址 <span class="text-danger">必填</span></label>
                <input type="text" class="form-control" id="address" name="agency[address]" value="{{ $agency->address }}">
            </div>
            <div class="form-group mb-3">
                <label for="telephone">联系电话 <span class="text-danger">必填</span></label>
                <input type="tel" class="form-control" id="telephone" name="agency[telephone]" value="{{ $agency->telephone }}">
            </div>
            <div class="form-group mb-3">
                <label for="website">网址 <span class="text-danger">必填</span></label>
                <input type="url" class="form-control" id="website" name="agency[website]" value="{{ $agency->website }}">
            </div>
            <div class="form-group mb-3">
                <label for="email">邮箱地址 <span class="text-danger">必填</span></label>
                <input type="email" class="form-control" id="email" name="agency[email]" value="{{ $agency->email }}" disabled>
            </div>
            <div class="form-group mb-3">
                <label for="started_on">开办日期 <span class="text-danger">必填</span></label>
                <input type="date" class="form-control" id="started_on" name="agency[started_on]" value="{{ $agency->started_on }}">
            </div>
            <div class="form-group mb-3">
                <label for="logo">机构Logo <span class="text-info">选填</span></label>
                <input type="file" class="form-control-file" id="logo" name="logo">
            </div>
            <div class="form-group mb-3">
                <label for="thumbnail">机构封面图 <span class="text-info">选填</span></label>
                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-info btn-block">更新</button>
            </div>
        </form>
    </div>

@endsection
