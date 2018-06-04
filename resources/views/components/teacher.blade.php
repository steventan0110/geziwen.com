
<div class="col-sm-4 text-center mt-4 pl-2 pr-2 mb-3">

    <a href="{{ route('agency.teacher.show', ['id'=> $agency->id,'id'=>$teacher->id]) }}"><img class="rounded-circle mb-2" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140px" height="140px"></a>
    <div  class="mt-3 mb-2" style="overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;height:25px;">
        <h5><a href="{{ route('agency.teacher.show', ['id'=> $agency->id,'id'=>$teacher->id]) }}" class="text-info">{{ $teacher->name }}</a></h5>
    </div>

    <div  style="overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical;height:70px;align-self: center">
        <p class="small" style="margin-left: 10%;margin-right: 10%; ; text-align:justify; text-justify:inter-ideograph; align-self: center">{{ $teacher->introduction }}</p>
    </div>
    @can('update', $teacher)
        <div class="mt-3">
            <a class="btn btn-warning btn-sm "
            href="{{ route('agency.teachers.edit', ['agency' => $agency->id, 'teacher' => $teacher->id]) }}"> 编辑 </a>
            <a class="btn btn-danger btn-sm text-white "
               data-toggle="modal" data-target="#deleteTeacherModalCenter-{{$teacher->id}}"

               > 删除 </a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteTeacherModalCenter-{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterDeleteTeacher" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"> 确认删除 </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="font-size: small">请问您确认删除{{$teacher->name}}的所有信息吗？您的操作将不可逆转</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>

                        <button class="btn btn-danger btn-small"
                           onclick="event.preventDefault()
                            document.getElementById('{{$teacher->id}}-delete-form').submit();">确认</button>
                        <form id="{{$teacher->id}}-delete-form" method="post"
                              action="{{route('agency.teachers.destroy', ['agency' => $agency->id, 'teacher' => $teacher->id])}}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</div>