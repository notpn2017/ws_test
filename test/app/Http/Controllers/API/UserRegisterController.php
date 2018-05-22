<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;
use App\User;

class UserRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'username' => 'unique:users|required|min:6',
            'password' => 'required|min:6',
            'phone_number' => 'required|regex:/(01)[0-9]{9}/',
            'birthday' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['username'] =  $user->username;

        return redirect('user/'.$user->username.'/show')->with('message', 'You have registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function view($username)
    {
        $users = User::where('username', $username)->get();
        return view('user.view', ['users' => $users]);
    }

    public function show(Request $request, $username)
    {
        $validator = $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = User::where('username', $username)->first();

        if($user && \Hash::check($request->password, $user->password)) {
            return view('user.show', ['user' => $user]);
        } else {
            return back()->with('error', 'You have entered wrong password. Please try agian.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $users = User::where('username', $username)->get();
        return view('user.update', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $validator = $request->validate([
            'username' => 'min:6',
            'password' => 'required|min:6',
            'phone_number' => 'required|regex:/(01)[0-9]{9}/',
            'birthday' => 'required',
        ]);

        $user = User::where('username',$username)->first();
        $user->password         = bcrypt($request->password);
        $user->phone_number     = $request->phone_number;
        $user->birthday         = $request->birthday;
        $user->address          = $request->address;
        $user->bio              = $request->bio;

        $user->save();
        return \Redirect::to('user')->with('message', 'You have updated user successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($username) 
    {
        $users = User::where('username', $username)->get();
        return view('user.delete', ['users' => $users]);
    }

    public function destroy(Request $request, $username)
    {
        $validator = $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = User::where('username', $username)->first();
        if($user && \Hash::check($request->password, $user->password)) {
            $user->delete();

            return \Redirect::to('user')->with('message', 'You have deleted an user successfully!');
        } else {
            return back()->with('error', 'You have entered wrong password. Please try agian.');
        }
    }

    public function upAvatar($username) 
    {
        $user = User::where('username',$username)->first();
        return view('user.up_avatar', ['user' => $user]);
    }

    public function saveAvatar(Request $request, $username) 
    {
        $validator = $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = User::where('username', $username)->first();

        if($user && \Hash::check($request->password, $user->password)) {
            $avatarName = time().'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('avatar'), $avatarName);
            $user->avatar = $avatarName;
        
            $user->save();

            return back()   ->with('message','You have uploaded avatar successfully.')
                            ->with('avatar',$avatarName);
        } else {
            return back()->with('error', 'You have entered wrong password. Please try agian.');
        }
    }

}
