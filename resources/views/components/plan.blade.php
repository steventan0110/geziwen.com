<div class="media pt-3">
    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="row">
            <div class="col-sm-10">
                <strong class="d-block text-gray-dark">{{ $plan->name }}</strong>
                {{ $plan->introduction }}
            </div>
            <div class="col-sm-2">
                @cannot('update', $plan)
                    <a type="button" class="btn btn-info btn-sm float-right" href="{{ route('agency.plan.show', ['agency' => $agency->id, 'plan' => $plan->id]) }}">查看详细</a>
                @endcannot
                @can('update', $plan)
                    <div class="dropdown float-right">
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            动作
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                               href="{{ route('agency.plan.edit', ['agency' => $plan->agency->id, 'plan' => $plan->id]) }}">编辑</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#plan-{{ $plan->id }}-delete">删除</a>
                            <a class="dropdown-item"
                               href="{{ route('agency.plan.show', ['agency' => $plan->agency->id, 'plan' => $plan->id]) }}">查看详细</a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="modal fade" id="plan-{{ $plan->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="plan-{{ $plan->id }}-delete-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除方案</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>确认删除方案{{ $plan->name }}？</p>
                    <p>{{ $plan->introduction }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary col-5" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-danger col-5 mr-4" onclick="event.preventDefault();
                            document.getElementById('{{ $plan->id }}-delete-form').submit();">确认</button>
                    <form id="{{ $plan->id }}-delete-form" method="post"
                          action="{{ route('agency.plan.destroy', ['agency' => $plan->agency->id, 'plan' => $plan->id]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>