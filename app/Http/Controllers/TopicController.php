<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTopic;
use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //专题详情页面
    public function show(Topic $topic)
    {
        //带文章数的专题
        $topic = Topic::withCount('postTopics')
                      ->find($topic->id);

        //某个专题的文章数
        $posts = $topic->posts()
                    ->orderBy('created_at','desc')//按创建的时间进行排列
                    ->take(10)//取得前十条数据
                    ->get();

        //属于我的文章，但没有投稿
        $mePosts=Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();
        return view('topic.show',compact('topic','posts','mePosts'));
    }

    //投稿
    public function doSubmit(Topic $topic)
    {
        //这里不做表单数据验证
        $this->validate(request(),[
            'post_ids'=>'required|array'
        ]);
        $post_ids=request('post_ids');
        $topic_id=$topic->id;
        //循环创建添加文章到一个专题
        foreach ($post_ids as $post_id){
            PostTopic::firstOrCreate(compact('post_id','topic_id'));
        }

        return back();

    }
}
