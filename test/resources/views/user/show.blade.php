@extends('layouts.theme')
@section('content')
    <div class="container">
            <h3>{{ $user->username }}</h3>
            <table class="table table-border">
                <tr>
                    <td>Avatar</td>
                    @if(isset($user->avatar))
                    <td>
                        <a href="{{ URL::to('/user/'.$user->username.'/avatar') }}">
                            <img class="user-avatar" style="width: 200px;" src="/avatar/{{ $user->avatar }}" alt="User Avatar">
                        </a>
                    </td>
                    @else
                    <td>
                        <a href="{{ URL::to('/user/'.$user->username.'/avatar') }}">
                            <img src="/avatar/avatar-default.png" alt="Avatar Default"><br>
                            You should update your avatar. Click here to update the avatar.
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
            <a class="btn-update" href="{{ URL::to('/user/'.$user->username.'/update') }}">
                <input type="button" class="btn btn-success" value="Update">
            </a>
            <a class="btn-update" href="{{ URL::to('/user/'.$user->username.'/delete') }}">
                <input type="button" class="btn btn-warning" value="Delete">
            </a>

    </div>