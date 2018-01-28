
@extends('luo.common')
@inject('time_handle', 'App\Services\TimeHandleService')
@section('content')

    <div class="col-sm-8">
        <blockquote>
            <p><img src="{{$user->avator}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{ $user->name }}
            </p>


            <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
            @include('user.like',['target_user'=>$user])
        </blockquote>

    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @if(!empty($posts))
                        @foreach($posts as $post)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class=""><a href="/user/{{$user->id}}">{{$user->name}}</a> {{$time_handle->time_format($post->created_at)}}</p>
                                <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>

                                {!! $post->content  !!}

                            </div>
                        @endforeach
                    @endif
                    {{$posts->links()}}
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">

                    @foreach($star_users as $star_user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$star_user->name}}</p>
                            <p class="">关注：{{$star_user->stars_count}} | 粉丝：{{$star_user->fans_count}}｜ 文章：{{$star_user->posts_count}}</p>
                            @include('user.like',['target_user'=>$star_user])
                        </div>
                    @endforeach

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">

                    @foreach($fan_users as $fan_user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$fan_user->name}}</p>
                            <p class="">关注：{{$fan_user->stars_count}} | 粉丝：{{$fan_user->fans_count}}｜ 文章：{{$fan_user->posts_count}}</p>
                        </div>
                    @endforeach

                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->

@endsection

