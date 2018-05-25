
@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 所有师资
@endsection



@section('content')
    <div id="applicants" class="container mb-4">
        <div class="jumbotron box-shadow bg-white">
            <div class="media">
                <img class="ml-2 mr-3 img-thumbnail border border-info" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image" width="100px">
                <div class="media-body">

                        <h1><a href="{{ route('agencies.show', ['id' => $agency->id]) }}">{{ $agency->name }}</a> | <a href = "{{route('agency.applicants.index',['id'=>$agency->id])}}"> 所有案例 </a> </h1>
                        <p class="small">{{ $agency->introduction }}</p>
                </div>
            </div>
        </div>
    </div>

<div class="container" id="teachers">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-2">全部师资</h5>
            <div class="row">
                @foreach($teachers as $teacher)
                    <div class="col-sm-4 text-center mt-4  pl-2 pr-2">
                     <img class="rounded-circle mb-2" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140px" height="140px">
                     <h5>{{ $teacher->name }}</h5>
                         <p class="small">{{ $teacher->introduction }}</p>
                         <p class="small">
                           <a class="btn btn-info btn-sm" role="button"
                             href="{{ route('agency.teacher.show', ['id'=> $agency->id,'id'=>$teacher->id]) }}">查看详细</a>
                         </p>
                    </div>
                @endforeach
    </div>
    <small class="d-block text-right mt-3">
        <div class="container align-content-right">
            {{ $teachers->links('vendor.pagination.bootstrap-4') }}
        </div>
        {{-- TODO: Implement Teacher Pagination --}}

    </small>
    </div>
    </div>

