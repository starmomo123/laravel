<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller{
    public function index(){
        return view('blog.index');
    }
    public function getInfo(){
        return "Blog 你好";
    }

    public function getBlog(Request $request,$name,$age){
        echo $request->path().'<br>';
        echo $request->url().'<br>';
        echo $request->fullUrl().'<br>';
        echo $request->method().'<br>';
        var_dump($request->query());
        echo $request->input('name');
        echo '<br>';
        echo $name.$age.'<br>';
        exit;
    }
}