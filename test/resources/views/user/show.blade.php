@extends('layouts.theme')
@section('content')
    <div class="container">
    @if (isset($users))
        @foreach($users as $user)
            <h3>{{ $user->username }}</h3>
            <table class="table table-border">
                <tr>
                    <td>Avatar</td>
                    @if(isset($user->avatar))
                    <td>
                        <a href="{{ URL::to('/user/'.$user->username.'/avatar') }}">
                            <img style="width: 200px;" src="../avatar/{{ $user->avatar }}" alt="User Avatar">
                        </a>
                    </td>
                    @else
                    <td>
                        <a href="{{ URL::to('/user/'.$user->username.'/avatar') }}">
                            <img src="/avatar/avatar-default.png" alt="Avatar Default">
                        </a>
                    </td>
                    @endif
                </tr>
                <tr>
                    <td>Username</td>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <td>Phone number</td>
                    <td>{{ $user->phone_number }}</td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td>{{ $user->birthday }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <td>BIO</td>
                    <td>{{ $user->bio }}</td>
                </tr>
            </table>
            <a href="{{ URL::to('/user/'.$user->username.'/update') }}">
                <input type="button" class="btn btn-success" value="Update">
            </a>
            <a href="{{ URL::to('/user/'.$user->username) }}">
                <input type="button" class="btn btn-danger" value="Delete">
            </a>

        @endforeach
    @endif
    </div>