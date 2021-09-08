@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            <div>
                <search-component></search-component>
            </div>
            <div>
                <project-list></project-list>
            </div>
        </div>
    </div>
</div>


@endsection
