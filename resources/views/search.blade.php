@extends('layouts.app')

@section('content')

    <div class="container">
        <ais-index app-id="{{ config('scout.algolia.id') }}"
                   api-key="{{ config('scout.algolia.search') }}"
                   index-name="applicants_index">
            <h1>请输入关键字进行搜索</h1>
            <ais-input placeholder="Search contacts..." class="form-control"></ais-input>

            <ais-results>
                <template scope="{ result }">
                    <div>
                        <h1>@{{ result.surname }}</h1>
                        <h4>@{{ result.agency.name }} - @{{ result.agency.introduction }}</h4>
                        <ul>
                            <li>@{{ result.email }}</li>
                        </ul>
                    </div>
                </template>
            </ais-results>

        </ais-index>
    </div>

@endsection
