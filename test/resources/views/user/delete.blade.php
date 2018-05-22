@extends('layouts.theme')
@section('content')
    <div class="container">
    @foreach($users as $user)
        <h4>Delete username: {{ $user->username }}</h4>
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

        {{ Form::open(array('url' => 'user/' . $user->username, 'class' => 'pull-left')) }}
            <div class="form-group">
                {{ Form::label('password', 'Enter password') }}
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete this user', array('class' => 'btn btn-warning')) }}
            <a href="/user/{{ $user->username }}"><button type="button" class="btn btn-primary pull-right">Back</button></a>
        {{ Form::close() }}
        @endforeach
    </div>