<!DOCTYPE html> 
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Upload Avatar</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
</head>
<body>
    <div class="container">
    @if (isset($user))
        <h3>{{ $user->username }}</h3>
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
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        {{ Form::model($user, array('route' => array('avatar.upload.post', $user->username),'files' => true, 'method' => 'POST')) }}
            @if(isset($user->avatar))
                <img style="width: 200px;" src="/avatar/{{ $user->avatar }}" alt="User Avatar">
            @else
                <img src="/avatar/avatar-default.png" alt="">
            @endif
                <div class="form-group">
                    {{ Form::label('password', 'Enter password *') }}
                    <input style="width: 250px;" type="password" name="password" value="" class="form-control input-pass">
                </div>
                <div class="form-group">
                    {{ Form::file('avatar', null, array('class' => 'form-control')) }}
                </div>
            <a href="{{ URL::to('/user/'.$user->username.'/show') }}"><input type="submit" class="btn btn-success" value="Upload"></a>
            <a href="{{ URL::to('/user/'.$user->username) }}"><input type="button" class="btn btn-primary" value="Back"></a>
        {{ Form::close() }}
    @endif
    </div>
</body>