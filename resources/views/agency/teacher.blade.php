@extends('layouts.app')

@section('content')
    {{-- TODO: Implement this view --}}
    <div class="container" id="profile">
        <div class="jumbotron bg-white box-shadow">
            <div class="media row">
                <img class="ml-2 mr-3 img-thumbnail img-responsive border border-info" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image" width="100px">
                <div class="media-body mt-4">
                    <strong class="d-block text-gray-dark text-primary"><h2>{{ $teacher->name }}</h2></strong>
                </div>
            </div>
            <div class="media">
                <div class="media-body">
                    <p class="mt-4" ><p>教学科目:</p> {{ $teacher->subject }}</p>
                    <p class="mt-4"><p>所属中介:</p> {{ $teacher->name }}</p>

                </div>
            </div>
            <rating :my-comment-type="'{{ $teacher->comments[0]->commentable_type }}'"
                    :my-comment-index="'{{ $teacher->comments[0]->commentable_id }}'"
            >
            </rating>
            <hr class="my-4">
            <p class="small"><i class="mr-2 fas fa-phone"></i>{{ $teacher->agency->telephone }}</p>
            <p class="small"><i class="mr-2 fas fa-envelope"></i>{{ $teacher->agency->email }}</p>
        </div>

    </div>
    <div class="container" id="applicants">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h5 class="border-bottom border-gray pb-2 mb-0"><a href="#applicants"><i class="mr-2 fas fa-link"></i></a>案例</h5>
            @foreach ($teacher->agency->applicants as $applicant)
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
    @if ($user!=null)
        <comment-text :comment-data="'{{ $teacher->id }}'"
                      :user-name="'{{ $user->name }}'"
                      :comment-type="'{{ $teacher->comments[0]->commentable_type }}'"
                      :comment-index="'{{ $teacher->comments[0]->commentable_id }}'"></comment-text>
    @else
        <comment-text :comment-data="'{{ $teacher->id }}'"
                      :user-name="''"
                      :comment-type="'{{ $teacher->comments[0]->commentable_type }}'"
                      :comment-index="'{{ $teacher->comments[0]->commentable_id }}'"></comment-text>
    @endif
@endsection
