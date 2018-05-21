<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use App\User;

class UserController extends Controller
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
            'username' => 'required|min:6',
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
    public function show($username)
    {
        $users = \DB::table('users')->where('username', $username)->get();
        return view('user.show', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $users = \DB::table('users')->where('username', $username)->get();
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
        print_r($user); die();
        $user->password         = bcrypt($request->password);
        $user->phone_number     = $request->phone_number;
        $user->birthday         = $request->birthday;
        $user->address          = $request->address;
        $user->bio              = $request->bio;

        print_r($user); die();
        $user->save();
        \Session::flash('message', 'Successfully updated user!');
        return \Redirect::to('user')->with('success', 'You have updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upAvatar($username) {
        $user = User::where('username',$username)->first();
        //print_r($user); die();
        return view('user.up_avatar', ['user' => $user]);
    }

    public function saveAvatar(Request $request, $username) {
        $validator = $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'same:password'
        ]);

        $user = User::where('username', $username)->first();

        $input = $request->all();
        $avatarName = time().'.'.request()->avatar->getClientOriginalExtension();
        request()->avatar->move(public_path('avatar'), $avatarName);
        $user->avatar = $avatarName;
        
        $user->save();

        return back()   ->with('message','You have successfully upload avatar.')
                        ->with('avatar',$avatarName);

    }
}
