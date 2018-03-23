@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="card card-default">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#search-agencies" role="tab" aria-controls="search-agencies" aria-selected="false">中介</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#search-applicants" role="tab" aria-controls="search-applicants" aria-selected="true">案例</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#search-teachers" role="tab" aria-controls="search-teachers" aria-selected="false">师资</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content text-left">
                        <div class="tab-pane fade show active" id="search-agencies">
                            <search algolia-app-id="{{ config('scout.algolia.id') }}"
                                    algolia-api-key="{{ config('scout.algolia.search') }}"
                                    algolia-index="agencies_index"></search>
                        </div>
                        <div class="tab-pane fade" id="search-applicants">
                            <search algolia-app-id="{{ config('scout.algolia.id') }}"
                                    algolia-api-key="{{ config('scout.algolia.search') }}"
                                    algolia-index="applicants_index"></search>
                        </div>
                        <div class="tab-pane fade" id="search-teachers">
                            <search algolia-app-id="{{ config('scout.algolia.id') }}"
                                    algolia-api-key="{{ config('scout.algolia.search') }}"
                                    algolia-index="teachers_index"></search>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
