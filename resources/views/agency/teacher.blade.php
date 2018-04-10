@extends('layouts.app')

@section('title')
    {{ $teacher->agency->name }} | {{ $teacher->name }}
@endsection
@section('content')
    {{-- TODO: Implement this view --}}
    <div class="container">
        <h1 class="display-4">{{ $teacher->id }}</h1>
        <h1 class="display-4">{{ $teacher->name }}</h1>
        <h1 class="display-4">{{ $teacher->agency->name }}</h1>
    </div>
@endsection
