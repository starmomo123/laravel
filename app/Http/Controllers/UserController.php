<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
class UserController extends Controller
{

    //个人主页
    public function index(User $user)
    {
        //分页的第page页
        $page=request('page');
        //得到当前用户的写的文章列表
        $posts = Post::where('user_id',$user->id)
            ->orderBy('created_at','desc')
            ->limit(($page-1)*2,2)
            ->paginate(2);
        //当前用户写的文章总数
        //$total = $posts->total();

        //得到当前用户的关注数,粉丝数
        $user = User::withCount(['fans','stars','posts'])->find($user->id);
        //得到当前用户关注的用户的文章数、粉丝数、关注数
        $stars = $user->stars;
        //使用$stars->pluck('star_id')可以获取某个字段的所有值
        $star_users=User::whereIn('id',$stars->pluck('star_id'))
                   ->withCount(['posts','stars','fans'])
                   ->get();
        //得到当前用户的粉丝用户的文章数、粉丝数、关注数
        $fans=$user->fans;
        $fan_users=User::whereIn('id',$fans->pluck('fan_id'))
            ->withCount(['posts','stars','fans'])
            ->get();
        return view('user.index',compact('user','posts','star_users','fan_users'));
    }

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

    //用户关注
    public function doStar(User $user)
    {
        $me=\Auth::user();
        if($me->doStar($user->id)){
            return [
                'code'=>1,
                'msg'=>"关注成功"
            ];
        }else{
            return [
                'code'=>0,
                'msg'=>"关注失败"
            ];
        }
    }

    //用户取消关注
    public function doUnStar(User $user)
    {
        $me=\Auth::user();
        if($me->doUnStar($user->id)){
            return [
                'code'=>1,
                'msg'=>"取消关注成功"
            ];
        }else{
            return [
                'code'=>0,
                'msg'=>"取消关注失败"
            ];
        }
    }

}
