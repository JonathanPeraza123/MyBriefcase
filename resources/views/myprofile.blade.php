@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container col-md-4 mb-4">
            <profile-component auth="{{ Auth::user()->toJson() }}" perfil="{{ Auth::user()->profile->toJson() }}"></profile-component>
        </div>
        <div class="container col-md-8">
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
</div>


@endsection
