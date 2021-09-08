@extends('layouts.app')

@section('content')

<div class="container d-flex">
    <div class="container col-4">
        <profile user="{{$user->profile}}"></profile>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    <project-component projects="{{ $user->projects }}"></project-component>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
