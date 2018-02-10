
@extends('admin.common.index')
@section('main')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">通知列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/notices/create">增加通知</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>通知名称</th>
                                <th>操作</th>
                            </tr>
                            @foreach($notices as $notice)
                                <tr>
                                    <td>{{$notice->id}}</td>
                                    <td>{{$notice->title}}</td>
                                    <td>
                                        <a type="button" class="btn resource-delete" delete-url="" href="/admin/notices/{{$notice->id}}" >删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection