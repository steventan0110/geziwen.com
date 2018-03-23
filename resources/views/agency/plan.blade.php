@extends('layouts.app')

@section('content')

    <div id="features" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($plan->features as $feature)
                <li data-target="#features" data-slide-to="{{ $loop->index }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($plan->features as $feature)
                <div class="carousel-item{{ $loop->index === 0 ? " active" : "" }}">
                    <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption text-left">
                            <h1>{{ $feature->name }}</h1>
                            <p>{{ $feature->introduction }}</p>
                            <p><a class="btn btn-lg btn-primary" href="#steps" role="button">查看服务流程</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#features" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#features" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div id="agency" class="container">
        <div class="page-header">
            <h5 class="border-bottom border-gray pb-2 mb-0"><a href="#agency"><i class="mr-2 fas fa-link"></i></a>中介信息</h5>
        </div>
        <div class="jumbotron bg-white box-shadow mt-4">
            <div class="media">
                <img class="ml-2 mr-3 img-thumbnail border border-info" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image" width="100px">
                <div class="media-body">
                    <h3>{{ $plan->agency->name }}</h3>
                    <p class="small">{{ $plan->agency->introduction }}</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-sm-8">
                    <p class="small"><i class="mr-2 fas fa-map-marker"></i>{{ $plan->agency->address }}</p>
                    <p class="small"><i class="mr-2 fas fa-phone"></i>{{ $plan->agency->telephone }}</p>
                    <p class="small"><i class="mr-2 fas fa-envelope"></i>{{ $plan->agency->email }}</p>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-primary float-right" href="{{ route('agency.show', ['id' => $plan->agency->id]) }}">前往主页</a>
                </div>
            </div>
        </div>
    </div>
    <div id="steps" class="container">
        <div class="page-header">
            <h5 class="border-bottom border-gray pb-2 mb-0"><a href="#steps"><i class="mr-2 fas fa-link"></i></a>服务流程</h5>
        </div>
        <ul class="timeline">
            @foreach($plan->steps as $step)
                <li class="{{ $loop->index % 2 ? "timeline-inverted" : "" }}">
                    <div class="timeline-badge {{ ["primary", "secondary", "success", "danger", "warning", "info"][random_int(0, 5)] }}">
                        <i class="fas fa-hand-{{ $loop->index % 2 ? "point-right" : "point-left" }}"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">{{ $step->name }}</h4>
                            <p><small class="text-muted"><i class="fas fa-calendar mr-2"></i>{{ $step->period }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>{{ $step->introduction }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="applicants" class="container">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-0"><a href="#applicants"><i class="mr-2 fas fa-link"></i></a>往期案例</h5>
            @foreach ($plan->applicants as $applicant)
                <div class="media pt-3">
                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark"><a href="#" class="btn btn-link btn-sm pl-0">{{ $applicant->surname }}</a></strong>
                        {{ $applicant->offers[0]->university->name }}
                        {{-- TODO: Implement detailed applicant information --}}
                    </div>
                </div>
            @endforeach
            <small class="d-block text-right mt-3">
                <a href="">查看所有案例</a>
                {{-- TODO: Implement Applicant Pagination --}}
            </small>
        </div>
    </div>

@endsection
