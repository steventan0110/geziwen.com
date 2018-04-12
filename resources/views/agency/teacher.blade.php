@extends('layouts.app')

@section('title')
    {{ $teacher->agency->name }} | {{ $teacher->name }}
@endsection
@section('content')
    {{-- TODO: Implement this view --}}
    <div class="container" id="profile">
        <div class="jumbotron bg-white box-shadow">
            <div class="media row">
                <img class="ml-2 mr-3 img-thumbnail img-responsive border border-info" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image" width="100px">
                <div class="media-body mt-4">
                    <strong class="d-block text-gray-dark text-primary"><h2>{{ $teacher->name }}</h2></strong>
                </div>
            </div>
            <div class="media">
                <div class="media-body">
                    <p class="mt-4" ><p>教学科目:</p> {{ $teacher->introduction }}</p>
                    <p class="mt-4"><p>所属中介:</p> {{ $teacher->name }}</p>

                </div>
            </div>
            <rating :my-comment-type="'{{ $teacher->comments[0]->commentable_type }}'"
                    :my-comment-index="'{{ $teacher->comments[0]->commentable_id }}'"
            >
            </rating>
            <hr class="my-4">
            <p class="small"><i class="mr-2 fas fa-phone"></i>{{ $teacher->agency->telephone }}</p>
            <p class="small"><i class="mr-2 fas fa-envelope"></i>{{ $teacher->agency->email }}</p>
        </div>

    </div>

    <div id="applicants" class="container mb-4">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-0">部分案例</h5>
            @foreach ($teacher->applicants as $applicant)
                @component('components.applicant', ['applicant' => $applicant])

                @endcomponent
            @endforeach
            <small class="d-block text-right mt-3">
                <a href="{{ route('teacher.applicants.index', ['id' => $teacher->id]) }}">查看所有案例</a>
            </small>
        </div>
    </div>

    <div class="container" id="comments">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-2">评论</h5>
            @auth
                <comment-text :comment-data="'{{ $teacher->id }}'"
                              :user-name="'{{ $user->name }}'"
                              :comment-type="'{{ $teacher->comments[0]->commentable_type }}'"
                              :comment-index="'{{ $teacher->comments[0]->commentable_id }}'"></comment-text>
            @else
                <comment-text :comment-data="'{{ $teacher->id }}'"
                              :user-name="''"
                              :comment-type="'{{ $teacher->comments[0]->commentable_type }}'"
                              :comment-index="'{{ $teacher->comments[0]->commentable_id }}'"></comment-text>
            @endauth
        </div>
    </div>
@endsection
