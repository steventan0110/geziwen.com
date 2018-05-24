@extends('layouts.app')

@section('title')
    新机构入驻
@endsection

@section('content')

    <div id="agency" class="container">
        <form action="{{ route('agencies.store') }}" method="post" class="bg-white box-shadow jumbotron">
            @method('POST')
            @csrf
            <h2>基本信息</h2>
            <div class="form-group mb-3">
                <label for="name">机构名称</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group mb-3">
                <label for="introduction">机构简介</label>
                <textarea class="form-control" id="introduction" name="introduction"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="address">地址</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="form-group mb-3">
                <label for="telephone">联系电话</label>
                <input type="tel" class="form-control" id="telephone" name="telephone">
            </div>
            <div class="form-group mb-3">
                <label for="website">网址</label>
                <input type="url" class="form-control" id="website" name="website">
            </div>
            <div class="form-group mb-3">
                <label for="email">邮箱地址</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group mb-3">
                <label for="started_on">开办日期</label>
                <input type="date" class="form-control" id="started_on" name="started_on">
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-info btn-block">申请入驻</button>
            </div>
        </form>
    </div>

@endsection
