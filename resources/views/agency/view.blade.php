@extends('layouts.app')

@section('content')
    <div class="container pt-4" id="profile">
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
                        <a href="{{ route('agency.plan.show', ['id' => $plan->id]) }}"
                           class="btn btn-lg btn-block btn-primary">了解更多</a>
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
                        <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#applicant-{{ $applicant->id }}">查看详细</button>
                        {{-- TODO: Implement detailed applicant information --}}
                    </div>
                    <div class="modal fade" id="applicant-{{ $applicant->id }}" tabindex="-1" role="dialog" aria-labelledby="applicant-{{ $applicant->id }}-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="applicant-{{ $applicant->id }}-title">{{ $applicant->surname }}同学</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#applicant-{{ $applicant->id }}-offers" role="tab" aria-controls="applicant-{{ $applicant->id }}-offers" aria-selected="true">Offer</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-exams" role="tab" aria-controls="applicant-{{ $applicant->id }}-exams" aria-selected="false">分数</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-activities" role="tab" aria-controls="applicant-{{ $applicant->id }}-activities" aria-selected="false">活动</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-awards" role="tab" aria-controls="applicant-{{ $applicant->id }}-awards" aria-selected="false">奖项</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content text-left">
                                                <div class="tab-pane fade show active" id="applicant-{{ $applicant->id }}-offers">
                                                    @foreach($applicant->offers as $offer)
                                                        <h6>
                                                            <span class="badge badge-{{ ["primary", "secondary", "success", "danger", "warning", "info"][$offer->plan->id] }}">
                                                                {{ $offer->plan->shorthand }}
                                                            </span>
                                                            {{ $offer->university->name }}
                                                        </h6>
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane fade" id="applicant-{{ $applicant->id }}-exams">
                                                    @if($applicant->toefl !== null)
                                                        <h6>
                                                            TOEFL:
                                                            <span class="badge badge-pill badge-primary">阅读</span> {{ $applicant->toefl->reading }}
                                                            <span class="badge badge-pill badge-secondary">听力</span> {{ $applicant->toefl->listening }}
                                                            <span class="badge badge-pill badge-success">口语</span> {{ $applicant->toefl->speaking }}
                                                            <span class="badge badge-pill badge-danger">写作</span> {{ $applicant->toefl->writing }}
                                                        </h6>
                                                    @endif
                                                    @if($applicant->ielts !== null)
                                                        <h6>
                                                            IELTS:
                                                            <span class="badge badge-pill badge-primary">阅读</span> {{ floatval($applicant->ielts->reading) / 2 }}
                                                            <span class="badge badge-pill badge-secondary">听力</span> {{ floatval($applicant->ielts->listening) / 2 }}
                                                            <span class="badge badge-pill badge-success">口语</span> {{ floatval($applicant->ielts->speaking) / 2 }}
                                                            <span class="badge badge-pill badge-danger">写作</span> {{ floatval($applicant->ielts->writing) / 2 }}
                                                        </h6>
                                                    @endif
                                                    @if($applicant->sat !== null)
                                                        <h6>
                                                            SAT:
                                                            <span class="badge badge-pill badge-primary">阅读</span> {{ $applicant->sat->reading }}
                                                            <span class="badge badge-pill badge-secondary">语法</span> {{ $applicant->sat->writing }}
                                                            <span class="badge badge-pill badge-success">数学</span> {{ $applicant->sat->math }}
                                                            <span class="badge badge-pill badge-danger">写作</span> {{ $applicant->sat->essay }}
                                                        </h6>
                                                    @endif
                                                    @if($applicant->act !== null)
                                                        <h6>
                                                            ACT:
                                                            <span class="badge badge-pill badge-primary">阅读</span> {{ $applicant->act->reading }}
                                                            <span class="badge badge-pill badge-secondary">英语</span> {{ $applicant->act->english }}
                                                            <span class="badge badge-pill badge-success">数学</span> {{ $applicant->act->math }}
                                                            <span class="badge badge-pill badge-danger">科学</span> {{ $applicant->act->science }}
                                                        </h6>
                                                    @endif
                                                    @if(count($applicant->satSubjects))
                                                        @foreach($applicant->satSubjects as $exam)
                                                            <h6>
                                                                SAT II:
                                                                <span class="badge badge-pill badge-primary">{{ $exam->subject }}</span> {{ $exam->score }}
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                    @if(count($applicant->aps))
                                                        @foreach($applicant->aps as $exam)
                                                            <h6>
                                                                AP:
                                                                <span class="badge badge-pill badge-primary">{{ $exam->subject }}</span> {{ $exam->score }}
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="tab-pane fade" id="applicant-{{ $applicant->id }}-activities">
                                                    @foreach($applicant->activities as $activity)
                                                        <h6>
                                                            <span class="badge badge-{{ ["primary", "secondary", "success", "danger", "warning", "info"][$activity->type->id % 6] }}">
                                                                {{ $activity->type->name }}
                                                            </span>
                                                            {{ $activity->name }}
                                                        </h6>
                                                    @endforeach
                                                </div>
                                                <div class="tab-pane fade" id="applicant-{{ $applicant->id }}-awards">
                                                    @foreach($applicant->awards as $award)
                                                        <h6>
                                                            <span class="badge badge-{{ ["primary", "secondary", "success", "danger", "warning", "info"][intval(explode('-', $award->received_on)[0]) % 6] }}">
                                                                {{ $award->received_on }}
                                                            </span>
                                                            {{ $award->name }}
                                                        </h6>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                </div>
                            </div>
                        </div>
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
    <comment-text :comment-data="'{{ $agency->id }}'" :comment-type="'{{ $agency->comments[0]->commentable_type }}'"></comment-text>
@endsection
