@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 编辑信息
@endsection

@section('content')

    <div id="agency" class="container">
        <form action="{{ route('agencies.update', ['id' => $agency->id]) }}" method="post" class="bg-white box-shadow jumbotron">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-sm-3 mb-3">
                    <img src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg"
                         alt="" class="ml-2 mr-3 img-thumbnail border border-info float-right" height="100px" width="100px">
                </div>
                <div class="col-sm-9">
                    <h2>编辑基本信息</h2>
                    <div class="form-group mb-3">
                        <label for="name">机构名称</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $agency->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="introduction">机构简介</label>
                        <textarea class="form-control" id="introduction" name="introduction">{{ $agency->introduction }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">地址</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $agency->address }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="telephone">联系电话</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ $agency->telephone }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="website">网址</label>
                        <input type="url" class="form-control" id="website" name="website" value="{{ $agency->website }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">邮箱地址</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $agency->email }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="started_on">开办日期</label>
                        <input type="date" class="form-control" id="started_on" name="started_on" value="{{ $agency->started_on }}">
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-info btn-block">更新</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
