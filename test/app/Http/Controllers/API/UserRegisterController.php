<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRegisterController extends Controller
{
    public function create() {
        return view('user.create');
    }

    public function store() {
        
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'c_password' => 'required|min:6|same:password',
            'birthday' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['username'] =  $user->username;

        $user->save();

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function edit()
    {
        $users = User::find($id);
        return view('user.edit', ['users' => $users]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'c_password' => 'required|min:6|same:password',
            'birthday' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['username'] =  $user->username;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $avatar->getClientOriginalName();
            $location = 'imagesetstyle(avatar, style)/' . $filename;
            \Image::make($avatar)->resize(800, 400)->save($location);
        }
        $user->avatar = 'avatar/'.$filename;
        $user->save();

        return $this->sendResponse($success, 'User register successfully.');
    }

}
