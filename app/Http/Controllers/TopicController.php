<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //专题详情页面
    public function show(Topic $topic)
    {
        return view('topic.show',compact('topic'));
    }

    //投稿
    public function doSubmit()
    {

    }
}
