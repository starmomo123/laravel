<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    //
    public function index()
    {
        $user=\Auth::user();
        //得到当前用户的通知
        $notices=$user->notices;
        return view('notice.index',compact('notices'));

    }
}
