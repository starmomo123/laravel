

@extends('admin.common.index')

@section('main')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px;text-align: center">ID</th>
                                <th style="text-align: center">文章标题</th>
                                <th style="text-align: center">操作</th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td style="text-align: center;line-height: 70px">{{$post->id}}</td>
                                    <td style="text-align: center;line-height: 70px">{{$post->title}}</td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="1" >通过</button>
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="-1" >拒绝</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$posts->links()}}
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection