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

    @component('components.agency', ['agency' => $plan->agency])
        @slot('button')
            <a href="{{ route('agency.show', ['id' => $plan->agency->id]) }}" class="btn btn-primary float-right">前往主页</a>
        @endslot
    @endcomponent

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
            <h5 class="border-bottom border-gray pb-2 mb-0"><a href="#applicants"><i class="mr-2 fas fa-link"></i></a>案例</h5>
            @foreach ($plan->applicants as $applicant)
                @component('components.applicant', ['applicant' => $applicant])

                @endcomponent
            @endforeach
            <small class="d-block text-right mt-3">
                <a href="">查看所有案例</a>
                {{-- TODO: Implement Applicant Pagination --}}
            </small>
        </div>
    </div>

@endsection
