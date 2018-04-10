@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 所有案例
@endsection

@section('content')

    <div id="applicants" class="container mb-4">
        <div class="jumbotron box-shadow bg-white">
            <div class="media">
                <img class="ml-2 mr-3 img-thumbnail border border-info" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image" width="100px">
                <div class="media-body">
                    <h5><a href="{{ route('agency.show', ['id' => $agency->id]) }}">{{ $agency->name }}</a> | 所有案例</h5>
                    <p class="small">{{ $agency->introduction }}</p>
                </div>
            </div>
            {{--<br class="my-2">--}}
            <div class="container mb-4">
                @foreach ($applicants as $applicant)
                    @component('components.applicant', ['applicant' => $applicant])

                    @endcomponent
                @endforeach
            </div>
            <div class="container align-content-right">
                {{ $applicants->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection