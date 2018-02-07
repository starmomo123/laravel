<?php
namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;

class RoleController extends Controller
{
    //后台首页
    public function index()
    {
        $roles=AdminRole::orderBy('id','asc')->paginate(4);
        return view('admin.role.index',compact('roles'));
    }

    //增加角色
    public function create()
    {
        return view('admin.role.create');
    }

    //增加角色的具体逻辑
    public function store()
    {
        $this->validate(request(),[
            'name'=>'required|min:2|string',
            'description'=>'required|min:2'
        ]);

        if(AdminRole::where('name',request('name'))->first()){
            return back()->withErrors("角色已经存在了");
        }

        $name=request('name');
        $description=request('description');

        if(AdminRole::create(compact('name','description'))){
            return redirect('/admin/roles');
        }

        return back()->withErrors("创建角色失败");
    }

    //当前角色的权限列表
    public function permission(AdminRole $role)
    {
        $permissions=AdminPermission::all();
        $myPermissions=$role->permissions;
        return view('admin.role.permission',compact('permissions','myPermissions','role'));
    }


    //当前角色的权限更新逻辑
    public function storePermission(AdminRole $role)
    {
        $this->validate(request(),[
            'permissions'=>"required|array"
        ]);
        //表单提交过来的roles
        $permissions=AdminPermission::findMany(request('permissions'));
        //当前用户拥有的roles
        $myPermissions=$role->permissions;

        //要增加的
        $addPermissions=$permissions->diff($myPermissions);
        foreach ($addPermissions as $permission){
            $role->grantPermisison($permission);
        }

        //要删除的
        $deletePermission =$myPermissions->diff($permissions);
        foreach ($deletePermission as $permission){
            $role->deletePermission($permission);
        }
        return redirect('/admin/roles');
    }
}
