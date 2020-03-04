<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
	public function __construct()
	{
		// 只让未登录用户访问登录页面	
		$this->middleware('guest', [
			'only'=>['login']
		]);
	}
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

    	if(Auth::attempt($credentials, $request->has('remember'))) {
    		session()->flash('success','欢迎回来!');
    		$fallback = route('users.show',Auth::user());
    		return redirect()->intended($fallback);
    	} else {
    		session()->flash('danger','抱歉,您的邮箱和密码不匹配！');
    	}
    	return redirect()->back()->withInput();
    }

    // 退出登录
    public function logout()
    {
    	Auth::logout();
    	session()->flash('success','您已成功退出~');
    	return redirect('login');
    }
}
