<div class="media pt-3">
    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">{{ $applicant->surname }}</strong>
        {{ $applicant->offers[0]->university->name }}
        <button class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#applicant-{{ $applicant->id }}">查看详细</button>
        @if(Auth::user()->can('update', $applicant))
            <a class="btn btn-warning btn-sm float-right mr-2"
               href="{{ route('agency.applicants.edit', ['agency' => $applicant->agency->id, 'applicant' => $applicant->id]) }}">编辑</a>
        @endif
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
                                @if(count($applicant->offers))
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#applicant-{{ $applicant->id }}-offers" role="tab" aria-controls="applicant-{{ $applicant->id }}-offers" aria-selected="true">Offer</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-exams" role="tab" aria-controls="applicant-{{ $applicant->id }}-exams" aria-selected="false">分数</a>
                                </li>
                                @if(count($applicant->activities))
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-activities" role="tab" aria-controls="applicant-{{ $applicant->id }}-activities" aria-selected="false">活动</a>
                                    </li>
                                @endif
                                @if(count($applicant->awards))
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-awards" role="tab" aria-controls="applicant-{{ $applicant->id }}-awards" aria-selected="false">奖项</a>
                                    </li>
                                @endif
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