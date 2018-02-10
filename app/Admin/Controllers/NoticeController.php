<?php
namespace App\Admin\Controllers;

use App\Notice;

class NoticeController extends Controller
{
    //后台首页
    public function index()
    {
        $notices=Notice::all();
        return view('admin.notice.index',compact('notices'));
    }

    //添加通知页面
    public function create()
    {
        return view('admin.notice.create');
    }

    //添加通知逻辑
    public function store()
    {
        $this->validate(request(),[
            'title'=>'required|min:2|string',
            'content'=>'required|min:2|string',
        ]);

        if(Notice::where('title',request('title'))->first()){
            return back()->withErrors("通知已经存在了");
        }

        $title=request('title');
        $content=request('content');

        $notice=Notice::create(compact('title','content'));

        $this->dispatch(new \App\Jobs\sendMessgae($notice));

        return redirect('admin/notices');
    }

    public function delete(Notice $notice)
    {
        $notice->delete();
        return back();
    }
}
