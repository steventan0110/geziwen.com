@extends('layouts.app')

@section('title')
    {{ $teacher->agency->name }} | {{ $teacher->name }}
@endsection
@section('content')
    <div class="container" id="teacher">
        <div class="jumbotron bg-white box-shadow">
            <div class="media">
                <img class="ml-2 mr-3 border border-info rounded-circle"
                     src="{{ asset('storage/' . $teacher->picture) }}" alt="Generic placeholder image" width="100px">
                <div class="media-body ml-3">
                    <h3>{{ $teacher->name }}</h3>
                    <p class="small mt-3">所属中介: <a href="{{ route('agency.show', ['id' => $teacher->agency->id]) }}">{{ $teacher->agency->name }}</a></p>
                    <p class="small mt-3">介绍: {{ $teacher->introduction }}</p>
                </div>
            </div>
            <rating :my-comment-type="'teachers'"
                    :my-comment-index="'{{ $teacher->id }}'"
                    class="mt-1 mt-lg-0"
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
                <a href="{{ route('teacher.applicant.index', ['id' => $teacher->id]) }}">查看所有案例</a>
            </small>
        </div>
    </div>

    <div class="container" id="comments">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            @auth
                <comment      :user-name="'{{ Auth::user()->name }}'"
                              :user-index="'{{ Auth::user()->id }}'"
                              :user-role="'{{ Auth::user()->role }}'"
                              :comment-type="'teachers'"
                              :comment-index="'{{ $teacher->id }}'"></comment>
            @else
                <comment      :user-name="''"
                              :user-index="'-1'"
                              :comment-type="'teachers'"
                              :comment-index="'{{ $teacher->id }}'"></comment>
            @endauth
        </div>
    </div>
@endsection
