@extends('layouts.theme')
@section('content')
    <div class="container">
    <h4>User Registeration</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        {!! Form::open(['route' => 'user.store', 'files' => true, 'method' => 'post']) !!}

            <div class="form-group">
                {{ Form::label('username', 'Username') }}
                {{ Form::text('username', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('phone_number', 'Phone Number') }}
                {{ Form::number('phone_number', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('birthday', 'Birthday') }}
                {{ Form::date('birthday', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('address', 'Adress') }}
                {{ Form::text('address', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('bio', 'BIO') }}
                {{ Form::text('bio', null, array('class' => 'form-control')) }}
            </div>
            <div>
                
                <a href="/user">
                    <button type="button" class="btn btn-danger cancel">Back</button>
                </a>
                <button type="submit" class="btn btn-successregister">Submit</button>
            </div>
        {!! Form::close() !!}
    </div>
    