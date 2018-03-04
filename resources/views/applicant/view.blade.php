@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">基本信息</div>
                    <img class="card-img-top"
                         alt="Card image cap"
                         src="https://exelord.com/ember-initials/images/default-d5f51047d8bd6327ec4a74361a7aae7f.jpg"/>
                    <div class="card-body">
                        <h5 class="card-title">{{ $profile['name'] }}</h5>
                        <p class="card-text">{{ $profile['introduction'] }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if(count($tests['toefl']) > 0)
                    <div class="card">
                        <div class="card-header">TOEFL</div>
                        <div class="card-body">
                            <div class="card-body">
                                <h5 class="card-title">最高拼分</h5>
                                <p class="card-header-tabs"></p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

@endsection
