
@extends('luo.common')

@section('content')
    <div class="alert alert-success" role="alert">
        下面是搜索"{{$query}}"出现的文章，共{{$total}}条
    </div>

    <div class="col-sm-8 blog-main">

        @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="/posts/{{$post->id}}" >{{$post->title}}</a></h2>
                <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by <a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></p>

                {{--对html标签不进行转义--}}
                {!! $post->content !!}
            </div>
        @endforeach

    </div><!-- /.blog-main -->

@endsection

