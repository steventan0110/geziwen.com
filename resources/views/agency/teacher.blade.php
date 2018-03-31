@extends('layouts.app')

@section('content')
    {{-- TODO: Implement this view --}}
    <div class="container" id="profile">
        <div class="jumbotron bg-white box-shadow">
            <div class="media">
                <img class="ml-2 mr-3 img-thumbnail img-responsive border border-info col-sm-4" src="http://p0.qhimgs4.com/t0182f84c96464af7b1.webp" alt="Generic placeholder image" width="100px">
                <div class="media-body ml-lg-5">
                    <strong class="d-block text-gray-dark text-primary"><h1>{{ $teacher->name }}</h1></strong>
                    <h5 class="mt-4">教学科目： {{ $teacher->subject }}</h5>
                    <h5 class="mt-4">所属中介： {{ $teacher->agency->name }}</h5>
                    <p class="mt-4 lead">简介： {{ $teacher->introduction }}</p>
                </div>
            </div>
            <hr class="my-4">
            <p class="small"><i class="mr-2 fas fa-phone"></i>{{ $teacher->agency->telephone }}</p>
            <p class="small"><i class="mr-2 fas fa-envelope"></i>{{ $teacher->agency->email }}</p>
        </div>
    </div>
    <div class="container" id="applicants">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-0"><a href="#applicants"><i class="mr-2 fas fa-link"></i></a>案例</h5>
            <table class="table table-striped">
                <caption>test</caption>
                <thead>
                <tr>
                    <th>学生名称</th>
                    <th>学生成绩</th>
                    <th>录取情况</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($teacher->agency->applicants as $applicant)
                    <tr class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <td><strong class="d-block text-gray-dark"><a href="#" class="btn btn-link btn-sm pl-0">{{ $applicant->surname }}</a></strong></td>
                        @if($applicant->sat==null)
                            <td>{{ $applicant->act }}</td>
                        @else
                            <td>{{ $applicant->sat }}</td>
                        @endif
                        <td>{{ $applicant->offers[0]->university->name }}</td>
                        <td>
                            <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">了解更多</button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">学生详情</h4>
                                        </div>
                                        {{-- TODO: Replace 'sats()' with teacher's subject--}}
                                        <div class="modal-body">
                                            <h3>成绩</h3>
                                            @if($applicant->sat==null)
                                                {{ $applicant->act }}
                                            @else
                                                {{ $applicant->sat }}
                                            @endif
                                            <h3>TOEFL成绩</h3>
                                            {{ $applicant->toefl }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <small class="d-block text-right mt-3">
                <a href="">查看所有案例</a>
                {{-- TODO: Implement Applicant Pagination --}}
            </small>
        </div>
        @if ($user!=null)
            <comment-text :comment-data="'{{ $teacher->id }}'"
                      :user-name="'{{ $user->name }}'"
                      :comment-type="'{{ $teacher->comments[0]->commentable_type }}'"></comment-text>
        @else
            <comment-text :comment-data="'{{ $teacher->id }}'"
                          :user-name="''"
                          :comment-type="'{{ $teacher->comments[0]->commentable_type }}'"></comment-text>
        @endif




    </div>
@endsection
