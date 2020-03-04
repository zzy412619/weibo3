<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        //除了下面这些动作外，其他都需要登录才能访问
        $this->middleware('auth',[
            'excpt' => ['show','signup','store']
        ]);

        // 只让未登录用户访问注册页面
        $this->middleware('guest',[
            'only' => ['signup']
        ]);
    }
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
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //注册后自动登录
        Auth::login($user);
        session()->flash('success','欢迎,您将在这里开启一段新的旅程~');

        return redirect()->route('users.show', [$user]);
    }

    //显示编辑用户信息页面
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }
    //修改用户信息
    public function update(User $user,Request $request)
    {
        $this->authorize('update',$user);
        $this->validate($request,[
            'name' =>'required|max:50',
            'password'=>'required|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
    

        session()->flash('success','用户信息更新成功');

        return redirect()->route('users.show', [$user]);

    }
}
