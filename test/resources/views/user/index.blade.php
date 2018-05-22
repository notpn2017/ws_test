@extends('layouts.theme')
@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/user">User managemant <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/create">Create new user</a>
                    </li>
                </ul>
            </div>
        </nav>
    @if (isset($users))
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
        @foreach($users as $user)
            <div class="col-md-4 user-info">
                @if(isset($user->avatar))
                    <img class="user-avatar" src="/avatar/{{ $user->avatar }}" alt="User Avatar">
                @else
                    <img class="user-avatar" src="/avatar/avatar-default.png" alt="Avatar Default">
                @endif
                <h3>User name: {{ $user->username }}</h3>
                <a href="{{ URL::to('/user/'.$user->username.'/view') }}"><input type="button" class="btn btn-success" value="View User"></a>
            </div>
        @endforeach
        </div>
    @endif
    </div>