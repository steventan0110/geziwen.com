@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="display-4">{{ $plan->id }}</h1>
        <h1 class="display-4">{{ $plan->name }}</h1>
        <h1 class="display-4">{{ $plan->agency->name }}</h1>
    </div>
@endsection
