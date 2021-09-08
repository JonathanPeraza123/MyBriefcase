@extends('layouts.app')

@section('content')
<div class="container">
    <project-show project="{{ $project }}" user="{{$user}}" profile="{{$profile}}"></project-show>
</div>

@endsection
