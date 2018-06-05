@extends('layouts.app')

@section('title')
    {{ $plan->agency->name }} | {{ $plan->name }}
@endsection

@section('content')

    <div id="steps" class="container mb-4">
        <div class="page-header">
            <h1 class="pb-2 mb-2">{{ $plan->name }}</h1>
            <p class="small">{{ $plan->introduction }}</p>
        </div>
        <ul class="timeline">
            @foreach($plan->steps as $step)
                <li class="{{ $loop->index % 2 ? "timeline-inverted" : "" }}">
                    <div class="timeline-badge {{ ["primary", "secondary", "success", "danger", "warning", "info"][$loop->index % 6] }}">
                        <i class="fas fa-stop"></i>
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

    <div id="applicants" class="container mb-4">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-0">部分案例</h5>
            @foreach ($plan->applicants as $applicant)
                @component('components.applicant', ['applicant' => $applicant])

                @endcomponent
            @endforeach
            <small class="d-block text-right mt-3">
                <a href="{{ route('plan.applicant.index', ['id' => $plan->id]) }}">查看所有案例</a>
            </small>
        </div>
    </div>

    @component('components.agency', ['agency' => $plan->agency])
        @slot('button')
            <a href="{{ route('agency.show', ['id' => $plan->agency->id]) }}" class="btn btn-info float-right">前往主页</a>
        @endslot
    @endcomponent

@endsection
