@extends('layouts.app')

@section('title')
    {{ $agency->name }}
@endsection

@section('content')

    @component('components.agency', ['agency' => $agency])
        @slot('button')
            <button class="btn btn-info btn-sm dropdown-toggle float-right" type="button"
                    id="view-more-dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                查看更多
            </button>
            <div class="dropdown-menu" aria-labelledby="view-more-dropdown-button">
                <a class="dropdown-item small" href="#services">服务</a>
                <a class="dropdown-item small" href="#applicants">案例</a>
                <a class="dropdown-item small" href="#teachers">师资</a>
            </div>
        @endslot
    @endcomponent

    <div class="container" id="services">
        <div class="row text-center">
            @foreach($agency->plans as $plan)
                <div class="col-lg-4 col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">{{ $plan->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">￥{{ $plan->price }}</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                @foreach($plan->features as $feature)
                                    <li>{{ $feature->name }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('agency.plan.show', ['agency' => $plan->agency->id, 'id' => $plan->id]) }}"
                               class="btn btn-sm btn-block btn-info">了解更多</a>
                        </div>
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
                <a href="{{ route('agency.applicant.index', ['id' => $agency->id]) }}" class="text-info">查看所有案例</a>
            </small>
        </div>
    </div>

    <div class="container" id="teachers">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-2">师资</h5>
            <div class="row">
                @foreach($agency->teachers as $teacher)
                    @component('components.teacher', ['teacher' => $teacher])

                    @endcomponent
                @endforeach
            </div>
            @if ($agency->teachers->count()>= 6)
            <small class="d-block text-right  mt-3">
                <a href="{{route('agency.teacher.index',['id'=>$agency->id]) }}" class="text-info">查看所有老师</a>
            </small>
            @endif
        </div>
    </div>

    <div class="container" id="comments">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            @auth
                @can('create', Auth::user())
                <comment      :user-name="'{{ Auth::user()->name }}'"
                              :user-index="'{{ Auth::user()->id }}'"
                              :user-role="'{{ Auth::user()->role }}'"
                              :comment-type="'agencies'"
                              :comment-index="'{{ $agency->id }}'"></comment>
                @endcan
            @else
                <comment      :user-name="''"
                              :user-index="-1"
                              :comment-type="'agencies'"
                              :comment-index="'{{ $agency->id }}'"></comment>
            @endauth
        </div>
    </div>
@endsection
