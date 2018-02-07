

<header class="main-header">
    <!-- Logo -->
    <a href="/admin/home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg text-gray">菜单列表</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="javascript:void (0)" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/adminle/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs text-aqua">{{\Auth::guard('admin')->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- 用户头像 -->
                        <li class="user-header">
                            <img src="/adminle/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                系统管理员 - Web开发者
                                <small>2018-1-30</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">音乐</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">游戏</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">工作</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Logo</a>
                            </div>
                            <div class="pull-right">
                                <a href="/admin/logout" class="btn btn-default btn-flat">退出</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>