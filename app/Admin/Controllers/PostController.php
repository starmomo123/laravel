<?php
namespace App\Admin\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //后台首页
    public function index(Request $request)
    {
        $page = $request->input('page',1);
        //不使用全局的scope
        $posts = Post::withoutGlobalScope('posts')
                    ->where('status',0)
                    ->orderBy('id','asc')
                    ->offset($page-1)
                    ->limit(4)
                    ->paginate(4);
        return view('admin.post.index',compact('posts'));
    }

    public function status(Post $post)
    {
        $staus = request('status');
        $post->status=$staus;
        if($post->save()){
            return ['error'=>0,'msg'=>"操作成功"];
        }else{
            return ['error'=>1,'msg'=>"操作失败"];
        }

    }
}
