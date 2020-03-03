<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function login()
    {
    	return view('sessions/login');
    }

    // 登录验证
    public function store(Request $request)
    {
    	$credentials = $this->validate($request,[
    		'email' => 'required|email|max:255',
    		'password' => 'required'
    	]);

    	if(Auth::attempt($credentials)) {
    		session()->flash('success','欢迎回来!');
    		return redirect()->route('users.show',[Auth::user()]);
    	} else {
    		session()->flash('danger','抱歉,您的邮箱和密码不匹配！');
    	}
    	return redirect()->back()->withInput();
    }
}
