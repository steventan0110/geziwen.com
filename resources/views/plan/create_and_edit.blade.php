@extends('layouts.app')

@section('title')
    {{ $agency->name }} |
    @create
    创建方案
    @endcreate
    @edit
    编辑方案
    @endedit
@endsection

@section('content')

    <div class="container" id="plan">

        @create
        <form action="{{ route('agency.plan.store', ['agency' => $agency->id]) }}" method="post">
            @endcreate
            @edit
            <form action="{{ route('agency.plan.update', ['agency' => $agency->id, 'plan' => $plan->id]) }}" method="post">
                @endedit
                {{ csrf_field() }}
                @edit
                    @method('PUT')
                @endedit
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
                <div class="bg-white box-shadow rounded p-3 mb-4">
                    <h5 class="border-bottom border-gray pb-2 mb-2">方案信息</h5>
                    <div class="form-group mb-3">
                        <label for="plan-name">方案名称</label>
                        <input type="text" class="form-control" id="plan-name"
                               name="plan[name]" @edit value="{{ $plan->name }}" placeholder="名称" @endedit />
                    </div>
                    <div class="form-group mb-3">
                        <label for="plan-price">方案价格</label>
                        <input type="number" class="form-control" id="plan-price"
                               name="plan[price]" @edit value="{{ $plan->price }}" placeholder="价格" @endedit />
                    </div>
                    <div class="form-group mb-3">
                        <label for="plan-intro">方案介绍</label>
                        <textarea type="text" class="form-control" id="plan-intro"
                                  name="plan[introduction]" @edit value="{{ $plan->introduction }}" placeholder="简介" @endedit ></textarea>
                    </div>
                    <h5 class="border-bottom border-gray pb-2 mb-2">方案特点</h5>
                    <plan-features @edit update="true" plan="{{ $plan->id }}" @endedit></plan-features>
                    <h5 class="border-bottom border-gray pb-2 mb-2">方案阶段</h5>
                    <plan-steps @edit update="true" plan="{{ $plan->id }}" @endedit></plan-steps>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-info">提交方案信息</button>
                    </div>
                </div>
            </form>
        </form>
    </div>

@endsection