@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 创建案例
@endsection

@section('content')

    <div class="container" id="applicant">
        <form action="{{ route('agency.applicants.store', ['agency' => $agency->id]) }}" method="post">
            {{ csrf_field() }}
            @method('POST')
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
                <div>
                    <h5 class="border-bottom border-gray pb-2 mb-2">案例信息</h5>
                    <input type="hidden" name="applicant_type" value="{{ $agency->type }}" >
                    <div class="form-group mb-3">
                        <label for="name">案例名称</label>
                        <input type="text" class="form-control" id="name" name="applicant[surname]">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">所属项目</label>
                        <div class="input-group mb-3">
                            <select type="email" class="form-control" id="email" name="applicant[plan]">
                                @foreach($agency->plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="introduction">案例介绍</label>
                        <textarea class="form-control" name="applicant[introduction]" id="introduc1tion"></textarea>
                    </div>
                </div>
                <div class="mb-4">
                    <h5 class="border-bottom border-gray pb-2 mb-2">标准化考试</h5>
                    <applicant-exams type="{{ $agency->type }}"></applicant-exams>
                </div>
                @if($agency->type == "standard")
                    <div class="mb-4">
                        <h5 class="border-bottom border-gray pb-2 mb-2">活动</h5>
                        <applicant-activities activity-types='{!! $activity_types !!}'></applicant-activities>
                    </div>
                    <div class="mb-4">
                        <h5 class="border-bottom border-gray pb-2 mb-2">奖项</h5>
                        <applicant-awards></applicant-awards>
                    </div>
                    <div class="mb-4">
                        <h5 class="border-bottom border-gray pb-2 mb-2">申请情况</h5>
                        <applicant-offers></applicant-offers>
                    </div>
                @endif
                <div class="mb-4">
                    <button type="submit" class="btn btn-info">提交案例信息</button>
                </div>
            </div>
        </form>
    </div>

@endsection