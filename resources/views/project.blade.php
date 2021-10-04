@extends('layouts.app')

@section('content')
<div class="container">
    <project-show project="{{ $project }}" user="{{$user}}" profile="{{$profile}}" images={{$image}}></project-show>
</div>

@endsection
