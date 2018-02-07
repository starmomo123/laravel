<?php
namespace App\Admin\Controllers;

use App\AdminPermission;

class PermissionController extends Controller
{
    //后台首页
    public function index()
    {
        $permissions=AdminPermission::orderBy('id','asc')->paginate(4);
        return view('admin.permission.index',compact('permissions'));
    }

    //增加权限
    public function create()
    {
        return view('admin.permission.create');
    }

    //增加权限的具体逻辑
    public function store()
    {
        $this->validate(request(),[
            'name'=>'required|min:2|string',
            'description'=>'required|min:2'
        ]);

        if(AdminPermission::where('name',request('name'))->first()){
            return back()->withErrors("权限已经存在了");
        }

        $name=request('name');
        $description=request('description');

        if(AdminPermission::create(compact('name','description'))){
            return redirect('/admin/permissions');
        }

        return back()->withErrors("创建权限失败");
    }
}
