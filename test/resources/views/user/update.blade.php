@extends('layouts.theme')
@section('content')
    <div class="container">
    @foreach($users as $user)
        <h4>Update username: {{ $user->username }}</h4>
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
        
        {{ Form::model($user, array('route' => array('user.update', $user->username),'files' => true, 'method' => 'PUT')) }}
        <div class="row">
            <div class="col-md-4">
                @if(isset($user->avatar))
                    <img style="width: 100%;" src="/avatar/{{ $user->avatar }}" alt="User Avatar">
                @else
                    <img src="/avatar/avatar-default.png" alt="">
                    <div class="form-group">
                        {{ Form::file('avatar', null, array('class' => 'form-control')) }}
                    </div>
                @endif
            </div>

            <div class="col-md-8">
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
            </div>
        </div>
            <div>
                <button type="button" class="btn btn-danger cancel">Cancel</button>
                <!-- <a href="{{ redirect()->back() }}"><input type="button" class="btn btn-danger cancel" value="Cancel"></a> -->
                <button type="submit" class="btn btn-success register">Update</button>
            </div>
        {!! Form::close() !!}
        @endforeach
    </div>