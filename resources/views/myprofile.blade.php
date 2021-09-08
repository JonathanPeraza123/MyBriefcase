@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <div class="container col-4">
        <profile-component auth="{{ Auth::user()->toJson() }}" perfil="{{ Auth::user()->profile->toJson() }}"></profile-component>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    <my-project></my-project>
                </div>
                <div class="card">
                    <project-form></project-form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
