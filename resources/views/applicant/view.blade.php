@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach ($applicants as $applicant)
            {{ $applicant->surname }}
        @endforeach
    </div>

{{--    {{ $applicants->links() }}--}}

@endsection
