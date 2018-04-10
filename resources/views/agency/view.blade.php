@extends('layouts.app')

@section('content')

    @component('components.agency', ['agency' => $agency])
        @slot('button')
            <button class="btn btn-primary dropdown-toggle float-right" type="button" id="view-more-dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                查看更多
            </button>
            <div class="dropdown-menu" aria-labelledby="view-more-dropdown-button">
                <a class="dropdown-item" href="#services">服务</a>
                <a class="dropdown-item" href="#applicants">案例</a>
                <a class="dropdown-item" href="#teachers">师资</a>
            </div>
        @endslot
    @endcomponent

    <div class="container" id="services">
        <div class="card-deck text-center">
            @foreach($agency->plans as $plan)
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{ $plan->name }} 项目</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">￥{{ $plan->price }}</h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            @foreach($plan->steps as $step)
                                <li>{{ $step->name }} Feature</li>
                                {{-- TODO: Implement Plan Featture Backend --}}
                                {{-- TODO: Implement Plan Profile Page --}}
                            @endforeach
                        </ul>
                        <a href="{{ route('agency.plan.show', ['id' => $plan->id]) }}"
                           class="btn btn-lg btn-block btn-success">了解更多</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="applicants" class="container mb-4">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-0">案例</h5>
            @foreach ($agency->applicants as $applicant)
                @component('components.applicant', ['applicant' => $applicant])

                @endcomponent
            @endforeach
            <small class="d-block text-right mt-3">
                <a href="" class="btn btn-link btn-disabled">查看所有案例</a>
                {{-- TODO: Implement Applicant Pagination --}}
            </small>
        </div>
    </div>

    <div class="container" id="teachers">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-2">师资</h5>
            <div class="row">
                @foreach($agency->teachers as $teacher)
                    <div class="col-sm-4 text-center mt-4  pl-2 pr-2">
                        <img class="rounded-circle mb-2" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                        <h5>{{ $teacher->name }}</h5>
                        <p class="small">{{ $teacher->introduction }}</p>
                        <p class="small">
                            <a class="btn btn-info btn-sm" role="button"
                               href="{{ route('agency.teacher.show', ['id' => $teacher->id]) }}">查看详细</a>
                        </p>
                    </div>
                @endforeach
            </div>
            <small class="d-block text-right mt-3">
                <a href="">查看所有老师</a>
                {{-- TODO: Implement Teacher Pagination --}}
            </small>
        </div>
    </div>

@endsection
