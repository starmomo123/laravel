


<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">左侧导航栏</li>
            @can('system')
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-envelope text-purple"></i> <span>系统管理</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/permissions"><i class="fa fa-circle-o text-red"></i> 权限列表</a></li>
                        <li><a href="/admin/users"><i class="fa fa-circle-o text-yellow"></i> 用户列表</a></li>
                        <li><a href="/admin/roles"><i class="fa fa-circle-o text-blue"></i> 角色列表</a></li>
                    </ul>
                </li>
            @endcan
            @can('posts')
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-edit text-green"></i> <span class="text-gray">文章管理</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/posts"><i class="fa fa-circle-o text-red"></i> 文章列表</a></li>
                    </ul>
                </li>
            @endcan
            @can('topic')
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-book text-light-blue"></i> <span>专题管理</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/topics"><i class="fa fa-circle-o text-green"></i> 专题列表</a></li>
                    </ul>
                </li>
            @endcan
            @can('notice')
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-envelope text-maroon"></i> <span>通知管理</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/notices"><i class="fa fa-circle-o text-blue"></i> 通知列表</a></li>
                    </ul>
                </li>
            @endcan
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>