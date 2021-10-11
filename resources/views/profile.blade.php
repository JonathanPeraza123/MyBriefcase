@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container col-md-4 mb-4">
            <profile user="{{$user->profile}}" correo="{{$user->email}}"></profile>
        </div>
        <div class="container col-md-8">
            <div class="row">
                <div class="col">
                    <div>
                        <project-component projects="{{ $user->projects }}"></project-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
