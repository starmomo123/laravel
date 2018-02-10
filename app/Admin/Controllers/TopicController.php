<?php
namespace App\Admin\Controllers;

use App\Topic;

class TopicController extends Controller
{
    //后台首页
    public function index()
    {
        $topics=Topic::all();
        return view('admin.topic.index',compact('topics'));
    }

    //添加专题页面
    public function create()
    {
        return view('admin.topic.create');
    }

    //添加专题逻辑
    public function store()
    {

        $this->validate(request(),[
            'topic'=>'required|min:2|string',
        ]);

        if(Topic::where('topic',request('topic'))->first()){
            return back()->withErrors("专题已经存在了");
        }

        $topic=request('topic');

        if(Topic::create(compact('topic'))){
            return redirect('/admin/topics');
        }

        return back()->withErrors("创建专题失败");
    }

    public function delete(Topic $topic)
    {
        $topic->delete();
        return back();
    }
}
