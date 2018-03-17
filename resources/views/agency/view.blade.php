@extends('layouts.app')

@section('content')
    <div class="container" id="profile">
        <div class="jumbotron bg-white box-shadow">
            <div class="media">
                <img class="ml-2 mr-3 img-thumbnail border border-info" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image" width="100px">
                <div class="media-body">
                    <h3>{{ $agency->name }}</h3>
                    <p class="small">{{ $agency->introduction }}</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-sm-8">
                    <p class="small"><i class="mr-2 fas fa-map-marker"></i>{{ $agency->address }}</p>
                    <p class="small"><i class="mr-2 fas fa-phone"></i>{{ $agency->telephone }}</p>
                    <p class="small"><i class="mr-2 fas fa-envelope"></i>{{ $agency->email }}</p>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-primary dropdown-toggle float-right" type="button" id="view-more-dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        查看更多
                    </button>
                    <div class="dropdown-menu" aria-labelledby="view-more-dropdown-button">
                        <a class="dropdown-item" href="#services">服务</a>
                        <a class="dropdown-item" href="#applicants">案例</a>
                        <a class="dropdown-item" href="#teachers">师资</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="services">
        <div class="card-deck mb-3 text-center">
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
                        <button type="button" class="btn btn-lg btn-block btn-primary">了解更多</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container" id="applicants">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-0"><a href="#applicants"><i class="mr-2 fas fa-link"></i></a>案例</h5>
            @foreach ($agency->applicants as $applicant)
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
    <div class="container" id="teachers">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-2"><a href="#teachers"><i class="mr-2 fas fa-link"></i></a>师资</h5>
            <div class="row">
                @foreach($agency->teachers as $teacher)
                    <div class="col-sm-4 text-center mt-4  pl-2 pr-2">
                        <img class="rounded-circle mb-2" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                        <h5>{{ $teacher->name }}</h5>
                        <p class="small">{{ $teacher->introduction }}</p>
                        <p class="small"><a class="btn btn-primary btn-sm " href="#" role="button">查看详细</a></p>
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
