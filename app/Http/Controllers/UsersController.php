<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //用户注册表单
    public function signup()
    {
    	return view('users.signup');
    }
    public function show(User $user)
    {
    	return view('users.show',compact('user'));
    }
    //创建注册用户
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min6'
        ]);

        
    }
}
