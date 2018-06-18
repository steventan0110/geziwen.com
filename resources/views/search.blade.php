@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="justify-content-center">
            <div class="rounded bg-white box-shadow">
                <div class="p-3 container">
                    <h2>搜索</h2>
                    <search algolia-app-id="{{ config('scout.algolia.id') }}"
                            algolia-api-key="{{ config('scout.algolia.search') }}"
                            scout-prefix="{{ config('scout.prefix') }}"
                            query="{{ Request::get('q') }}"
                    ></search>
                </div>
            </div>
        </div>
    </div>

@endsection
