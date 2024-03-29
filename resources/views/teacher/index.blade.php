
@extends('layouts.app')

@section('title')
    {{ $agency->name }} | 所有师资
@endsection

@section('content')

    @include('components.alert')

    <div id="applicants" class="container mb-4">
        <div class="jumbotron box-shadow bg-white">
            <div class="media">
                <img class="ml-2 mr-3 img-thumbnail border border-info" src="{{ asset('storage/' . $agency->logo)  }}" alt="Generic placeholder image" width="100px">
                <div class="media-body">
                    <h5>
                        <a href="{{ route('agency.show', ['id' => $agency->id]) }}" class="text-info">{{ $agency->name }}</a> | 全部师资</h5>
                    <p class="small">{{ $agency->introduction }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="teachers">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="row">
                @foreach($teachers as $teacher)
                    @component('components.teacher', ['agency'=> $agency,'teacher'=>$teacher])

                    @endcomponent
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
