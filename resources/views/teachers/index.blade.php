
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

                        <h5><a href="{{ route('agencies.show', ['id' => $agency->id]) }}">{{ $agency->name }}</a> | 全部师资 </a> </h5>
                        <p class="small">{{ $agency->introduction }}</p>
                </div>
            </div>
        </div>
    </div>

<div class="container" id="teachers">
        <div class="my-3 p-3 bg-white rounded box-shadow">

            <div class="row">
                @foreach($teachers as $teacher)
                    <div class="col-sm-4 text-center mt-4 pl-2 pr-2 mb-3">

                        <a href="{{ route('agency.teacher.show', ['id'=> $agency->id,'id'=>$teacher->id]) }}"><img class="rounded-circle mb-2" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140px" height="140px"></a>
                        <div  class="mt-3 mb-2" style="overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;height:25px;">
                            <h5><a href="{{ route('agency.teacher.show', ['id'=> $agency->id,'id'=>$teacher->id]) }}" class="text-info">{{ $teacher->name }}</a></h5>
                        </div>
                        <div  style="overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical;height:70px;align-self: center">
                        <p class="small" style="margin-left: 10%;margin-right: 10%; ; text-align:justify; text-justify:inter-ideograph; align-self: center">{{ $teacher->introduction }}</p>
                        </div>

                    </div>

                @endforeach
            </div>
    </div>
    <small class="d-block text-right mt-4GIT">
        <div class="container align-content-center">
            <ul class="pagination justify-content-center text-info">
            {{ $teachers->links('vendor.pagination.bootstrap-4') }}
            </ul>
        </div>
    </small>
</div>
@endsection
