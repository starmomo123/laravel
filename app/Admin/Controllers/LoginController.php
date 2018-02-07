<?php
namespace App\Admin\Controllers;

class LoginController extends Controller
{
    //登录首页
    public function index()
    {
        if(\Auth::guard('admin')->check()){
            return redirect('/admin/home');
        }
        return view('admin.login.index');
    }

    //登录逻辑
    public function login()
    {
        $this->validate(request(),[
            'name'=>'required|min:2|string',
            'password'=>'required|min:6|max:12'
        ]);
        $param['name']=request('name');
        //这路不需要加密
        $param['password']=request('password');

        if(\Auth::guard('admin')->attempt($param)){
            return redirect('/admin/home');
        }

        return back()->withErrors("用户名密码不正确");
    }

    //退出登录
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
