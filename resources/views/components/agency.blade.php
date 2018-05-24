<div id="agency" class="container">
    <div class="jumbotron bg-white box-shadow">
        <div class="media">
            <img class="ml-2 mr-3 img-thumbnail border border-info" src="{{$agency->thumbnail}}" alt="Generic placeholder image" width="100px">
            <div class="media-body">
                @if($agency->type==2)
                    <span class="badge badge-danger">语培</span>
                @else
                    <span class="badge badge-info">中介</span>
                @endif
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
                {{ $button }}
            </div>
        </div>
    </div>
</div>
