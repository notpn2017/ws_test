@extends('layouts.theme')
@section('content')
    <div class="container">
    @foreach($users as $user)
        <h4>username: {{ $user->username }}</h4>
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-warning">
                {{ session()->get('error') }}
            </div>
        @endif

        {{ Form::open(array('url' => 'user/'.$user->username.'/show/', 'class' => 'pull-left', 'method' => 'POST')) }}
            <div class="form-group">
                {{ Form::label('password', 'Enter password *') }}
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
            <a href="/user/"><button style="margin-left: 10px;" type="button" class="btn btn-primary pull-right">Back</button></a>
            <a href="/user/{{ $user->username }}/show"><button type="submit" class="btn btn-success pull-right">Go</button></a>
        {{ Form::close() }}
        @endforeach
    </div>