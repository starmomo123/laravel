<?php
namespace App\Admin\Controllers;

use App\AdminRole;
use App\AdminUser;

class UserController extends Controller
{
    //管理人员列表
    public function index()
    {
        $users = AdminUser::get();
        return view('admin.user.index',compact('users'));
    }

    //添加管理人员
    public function create()
    {
        return view('admin.user.create');
    }

    //增加管理人员具体逻辑
    public function store()
    {
        $this->validate(request(),[
            'name'=>'required|min:2|string',
            'password'=>'required|min:6|max:12'
        ]);

        if(AdminUser::where('name',request('name'))->first()){
            return back()->withErrors("用户已经存在了");
        }

        $name=request('name');
        //密码进行bcrypt加密
        $password=bcrypt(request('password'));

        if(AdminUser::create(compact('name','password'))){
            return redirect('/admin/users');
        }

        return back()->withErrors("创建用户失败");
    }

    //角色管理
    public function role(AdminUser $user)
    {
        $roles=AdminRole::all();
        $myRoles=$user->roles;
        return view('admin.user.role',compact('roles','myRoles','user'));
    }

    //角色管理逻辑
    public function updateRole(AdminUser $user)
    {
        $this->validate(request(),[
            'roles'=>"required|array"
        ]);
        //表单提交过来的roles
        $roles=AdminRole::findMany(request('roles'));
        //当前用户拥有的roles
        $myRoles=$user->roles;

        //要增加的
        $addRoles=$roles->diff($myRoles);
        foreach ($addRoles as $role){
            $user->assignRole($role);
        }

        //要删除的
        $deleteRoles =$myRoles->diff($roles);
        foreach ($deleteRoles as $role){
            $user->deleteRole($role);
        }
        return redirect('/admin/users');
    }

}
