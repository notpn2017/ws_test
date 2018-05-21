@extends('layouts.theme')
@section('content')
    <div class="container">
    @if (isset($users))
        @foreach($users as $user)
            <h3>{{ $user->username }}</h3>
            <a href="{{ URL::to('/user/'.$user->username) }}">Update</a>
        @endforeach
    @endif
    </div>