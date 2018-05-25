<div class="media pt-3">
    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">{{ $applicant->surname }}</strong>
        @if($applicant->plan->agency->type == 'standard')
            {{ $applicant->offers[0]->university->name }}
        @endif
        <button class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#applicant-{{ $applicant->id }}">查看详细</button>
        @auth
            @if(Auth::user()->can('update', $applicant))
                <a class="btn btn-warning btn-sm float-right mr-2"
                   href="{{ route('agency.applicants.edit', ['agency' => $applicant->plan->agency->id, 'applicant' => $applicant->id]) }}">编辑</a>
            @endif
        @endauth
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
                                    <a class="nav-link active" data-toggle="tab" href="#applicant-{{ $applicant->id }}-exams" role="tab" aria-controls="applicant-{{ $applicant->id }}-exams" aria-selected="false">分数</a>
                                </li>
                                @if($applicant->plan->agency->type == 'standard')
                                    @if(count($applicant->offers))
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-offers" role="tab" aria-controls="applicant-{{ $applicant->id }}-offers" aria-selected="true">Offer</a>
                                        </li>
                                    @endif
                                @endif
                                @if($applicant->plan->agency->type == 'standard')
                                    @if(count($applicant->activities))
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-activities" role="tab" aria-controls="applicant-{{ $applicant->id }}-activities" aria-selected="false">活动</a>
                                        </li>
                                    @endif
                                @endif
                                @if($applicant->plan->agency->type == 'standard')
                                    @if(count($applicant->awards))
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#applicant-{{ $applicant->id }}-awards" role="tab" aria-controls="applicant-{{ $applicant->id }}-awards" aria-selected="false">奖项</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content text-left">
                                <div class="tab-pane fade show active" id="applicant-{{ $applicant->id }}-exams">
                                   @foreach($applicant->exams as $exam)
                                       @component('components.exam', ['exam' => $exam])

                                       @endcomponent
                                   @endforeach
                                </div>
                                <div class="tab-pane fade" id="applicant-{{ $applicant->id }}-offers">
                                    @if($applicant->plan->agency->type == 'standard')
                                        @foreach($applicant->offers as $offer)
                                            <h6>
                                                <span class="badge badge-{{ ["primary", "secondary", "success", "danger", "warning", "info"][$offer->plan->id] }}">
                                                    {{ $offer->plan->shorthand }}
                                                </span>
                                                {{ $offer->university->name }}
                                            </h6>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="applicant-{{ $applicant->id }}-activities">
                                    @if($applicant->plan->agency->type == 'standard')
                                        @foreach($applicant->activities as $activity)
                                            <h6>
                                                <span class="badge badge-{{ ["primary", "secondary", "success", "danger", "warning", "info"][$activity->type->id % 6] }}">
                                                    {{ $activity->type->name }}
                                                </span>
                                                {{ $activity->name }}
                                            </h6>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="applicant-{{ $applicant->id }}-awards">
                                    @if($applicant->plan->agency->type == 'standard')
                                        @foreach($applicant->awards as $award)
                                            <h6>
                                                <span class="badge badge-{{ ["primary", "secondary", "success", "danger", "warning", "info"][intval(explode('-', $award->received_on)[0]) % 6] }}">
                                                    {{ $award->received_on }}
                                                </span>
                                                {{ $award->name }}
                                            </h6>
                                        @endforeach
                                    @endif
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