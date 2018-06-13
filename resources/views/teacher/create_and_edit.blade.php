@extends('layouts.app');

@section('title')
    @edit
        {{$teacher->name}} | 编辑信息
    @endedit
    @create
        {{$agency->name}} | 添加老师
    @endcreate
@endsection

@section('content')
    <div id="teacher" class="container">

        <form @edit enctype="multipart/form-data" action= "{{route('agency.teacher.update',['agency_id'=>$teacher->agency->id,'teacher_id'=>$teacher->id])}}" @endedit
        @create action= "{{route('agency.teacher.store',['agency_id'=>$agency->id])}}" @endcreate

                method="post"
                class="bg-white box-shadow jumbotron">
            {{ csrf_field() }}
            @edit @method('PUT') @endedit
            @create @method('POST') @endcreate

            <h5 class="border-bottom border-gray pb-2 mb-3">
                @edit 编辑老师信息 @endedit
                @create 添加老师 @endcreate
            </h5>

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
                <label for="name">老师名字</label>
                <input type="text" class="form-control" id="teacher_name" name="teacher[name]"
                       @edit value="{{ $teacher->name }}" @endedit>
            </div>
            <div class="form-group mb-3">
                <label for="introduction">老师介绍</label>

                <textarea type="text" class="form-control" id="teacher_introduction" name="teacher[introduction]" >@edit{{ $teacher->introduction}}@endedit</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="years_of_teaching">入职年数</label>
                <input type="number" class="form-control" id="years_of_teaching" name="teacher[years_of_teaching]" @edit value="{{ $teacher->years_of_teaching }}"@endedit>
            </div>
            <div class="form-group mb-3">
                <label for="subject">教授内容</label>
                <textarea type="text" class="form-control" id="subject" name="teacher[subject]" >@edit{{ $teacher->subject }} @endedit</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="image">教师头像</label>
                <input type="file" class="form-control-file" id="image" name="picture">
            </div>
            <div class="form-group mb-3 mt-3">
                <button type="submit" class="btn btn-info btn-block">
                    @edit 更新 @endedit
                    @create 新建 @endcreate
                </button>
            </div>
        </form>
    </div>




@endsection


