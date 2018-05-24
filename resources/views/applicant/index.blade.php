@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 所有案例
@endsection

@section('content')

    <div id="applicants" class="container mb-4">
        <div class="jumbotron box-shadow bg-white">
            <div class="media">
                <img class="ml-2 mr-3 img-thumbnail border border-info" src="{{$agency->thumbnail}}" alt="Generic placeholder image" width="100px">
                <div class="media-body">
                    @if(isset($plan))
                        <h5><a href="{{ route('agency.plan.show', ['id' => $plan->id]) }}">{{ $plan->name }}</a> | 所有案例</h5>
                    @elseif(isset($agency))
                        <h5><a href="{{ route('agencies.show', ['id' => $agency->id]) }}">{{ $agency->name }}</a> | 所有案例</h5>
                    @endif
                    @if(isset($plan))
                        <p class="small">{{ $plan->introduction }}</p>
                    @elseif(isset($agency))
                        <p class="small">{{ $agency->introduction }}</p>
                    @endif
                </div>
            </div>
            <div class="container mb-4">
                @foreach ($applicants as $applicant)
                    @include('components.applicant', ['applicant' => $applicant])
                @endforeach
            </div>
            <div class="container align-content-right">
                {{ $applicants->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection