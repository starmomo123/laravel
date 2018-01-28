<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    //文章列表页面
    function index(Request $request){
        $page=$request->input('page');
        $posts = Post::orderBy('created_at','desc')
                     ->withCount(['comments','zans'])//使用关联模型获取评论数和赞数
                     ->limit(($page-1)*4,4)
                     ->paginate(4);
        return view('posts.index',compact('posts'));
    }

    //文章详情页面
    function show($id){
        $post = Post::find($id);
        return view('posts.show',compact('post'));
    }

    //添加文章页面
    function create(){
        return view('posts.create');
    }

    //添加文章相关的逻辑
    function store(){
        //验证表单传递的数据
        //第一个参数是一个request()对象
        //第二个参数是表单传递过来的字段要求
        //第三个参数是一个错误信息的描述可有可无
        //[
            //'title.min'=>'参数长度必须是6个以上',
            //'content.min'=>'参数必须是10个以上'
        //]
        $this->validate(request(),[
            'title'=>'required|string|max:25|min:6',
            'content'=>'required|string|min:10'
        ]);
        $params=request()->all();
        unset($params['_token']);
        $user_id=\Auth::id();
        $params=array_merge($params,compact('user_id'));
        //具体的逻辑
        $post = Post::create($params);

        //渲染
        if($post){
            return redirect('posts');
        }
        //返回到上一次的url页面
        return \Redirect::back()->withErrors("创建文章失败");

    }

    //文章编辑页面
    function edit($id){
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    //编辑文章相关的逻辑
    function update(Post $post){
        $this->validate(request(),[
            'title'=>'required|string|max:25|min:6',
            'content'=>'required|string|min:10'
        ]);

        //用户是否有权限执行更新操作
        $this->authorize('update',$post);

        $post->title=request('title');
        $post->content=request('content');
        $bool=$post->save();
        if($bool){
            return redirect('posts');
        }

        return \Redirect::back()->withErrors("更新操作失败");

    }

    //删除文章页面
    function delete(Post $post){
        //todo 这里做权限认证
        //用户是否有权限执行更新操作
        $this->authorize('delete',$post);

        $bool = $post->delete();
        if($bool){
            return redirect('posts');
        }

        return \Redirect::back()->withErrors("删除操作失败");
    }

    //文章评论
     public function comment($id)
     {
         $post=Post::find($id);
         $this->validate(request(),[
            'content'=>'required|min:6'
         ]);

         $user_id=\Auth::id();
         $comment = new Comment();
         $comment->user_id=$user_id;
         $comment->post_id=$post->id;
         $comment->content=request('content');

         if($post->comments()->save($comment)){
             return back();
         }

         return back()->withErrors("增加评论失败");
     }

     //文章赞功能
     public function zan(Post $post)
     {
         $param=[
             'user_id'=>\Auth::id(),
             'post_id'=>$post->id
         ];
         //如果存在这条记录则返回,否则创建
         Zan::firstOrCreate($param);
         return back();
     }

     //文章取消赞功能
     public function unzan(Post $post)
     {
         $post->zan(\Auth::id())->delete();
         return back();
     }

    //等下处理图片上传
    public function imageUpload(Request $request){

    }
}
