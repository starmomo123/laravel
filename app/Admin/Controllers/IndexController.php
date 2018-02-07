<?php
namespace App\Admin\Controllers;

class IndexController extends Controller
{
    //后台首页
    public function index()
    {
        return view('admin.index.index');
    }
}
