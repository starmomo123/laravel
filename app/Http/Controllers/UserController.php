<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
        return view('user.setting');
    }

    //个人设置行为
    public function settingStore(Request $request)
    {
        //数据验证
        $this->validate(request(),[
            'name'=>'required|min:3'
        ]);
        //逻辑
        //判断姓名是否一致且没有被注册
        $user = \Auth::user();
        $name=request('name');
        if($name!=$user->name){
            if(User::where('name',$name)->count() > 0){
                return back()->withErrors("用户名已存在");
            }
            $user->name=$name;
        }

        if($request->file('avator')){
            $path = $request->file('avator')->storePublicly($user->id);
            $user->avator='/storage/'.$path;
        }
        if($user->save()){
           return back();
        }
        return back()->withErrors("头像上传失败");

//        //以时间来命名上传的文件
//        $today=date('Y-m-d');
//        //文件存储的路径
//        $dir=storage_path('app/public').$today;
//        if(!is_dir($dir)){
//            mkdir($dir);
//        }
//        //得到上传文件扩展名
//        $ext = $request->file('avator')->extension();
//        //文件存储名
//        $real_name=time().'-'.rand(10000,99999).'-laravel'.'.'.$ext;
//
//        $real_path=$dir.'/'.$real_name;
//
//        $path=$request->file('avator')->getRealPath();
//
//        if(!Storage::disk('public')->put($real_path,file_get_contents($path))){
//            return \Redirect::back()->withErrors("上传文件失败");
//        }
//
//        //更新用户头像avator字段
//        $avator_path=public_path().'/'.$today.'/'.$real_name;
//        $id=\Auth::id();
//        $user = User::find($id);
//        $user->name=request('name');
//        $user->avator=$avator_path;
//
//        //渲染视图
//        if($user->save()){
//            return redirect("/user/{$user->id}");
//        }
//        return \Redirect::back()->withErrors("用户保存头像失败");

    }
}
