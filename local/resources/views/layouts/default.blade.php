<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('dist/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('dist/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>48</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PHILS</b>48</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="{{asset('dist/img/default-user.png')}}" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">AJ Manaros</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{{asset('dist/img/default-user.png')}}" class="img-circle" alt="User Image">
                    <p>
                      AJ Manaros - Web Developer
                      <small>Member since Oct. 2015</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('dist/img/default-user.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>AJ Manaros</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{Request::path() == '/' ? 'active' : ''}}"><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="{{strpos(Request::path(),'member') !== false ? 'active' : ''}}"><a href="/member"><i class="fa fa-users"></i> <span>Member List</span></a></li>
            <li class="{{Request::path() == 'register' ? 'active' : ''}}"><a href="/register"><i class="fa fa-user-plus"></i> <span>Register Member</span></a></li>
            <li class="{{Request::path() == 'transaction' ? 'active' : ''}}"><a href="/transaction"><i class="fa fa-archive"></i> <span>Transaction History</span></a></li>
            <!-- <li class="{{Request::path() == 'reward' ? 'active' : ''}}"><a href="/reward"><i class="fa fa-money"></i> <span>Reward Program</span></a></li> -->
            
            <li class="treeview {{strpos(Request::path(),'reward') !== false ? 'active' : ''}}">
              <a href="::javascript()">
              <i class="fa fa-share"></i> <span>Reward Program</span>
              <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu " style="">
                <li class="{{Request::path() == 'reward' ? 'active' : ''}}"><a href="/reward"><i class="fa fa-circle-o"></i> Summary</a></li>
                <li class="{{strpos(Request::path(),'reward/pending') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Pending <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'reward/pending') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'reward/pending/1') !== false ? 'active' : ''}}"><a href="/reward/pending/1"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li class="{{strpos(Request::path(),'reward/pending/2') !== false ? 'active' : ''}}"><a href="/reward/pending/2"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li class="{{strpos(Request::path(),'reward/pending/3') !== false ? 'active' : ''}}"><a href="/reward/pending/3"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li class="{{strpos(Request::path(),'reward/pending/4') !== false ? 'active' : ''}}"><a href="/reward/pending/4"><i class="fa fa-circle-o"></i> Level Four</a></li>
                    <li class="{{strpos(Request::path(),'reward/pending/5') !== false ? 'active' : ''}}"><a href="/reward/pending/5"><i class="fa fa-circle-o"></i> Level Five</a></li>
                  </ul>
                </li>
                <li class="{{strpos(Request::path(),'reward/completed') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Completed <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'reward/completed') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'reward/completed/1') !== false ? 'active' : ''}}"><a href="/reward/completed/1"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li class="{{strpos(Request::path(),'reward/completed/2') !== false ? 'active' : ''}}"><a href="/reward/completed/2"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li class="{{strpos(Request::path(),'reward/completed/3') !== false ? 'active' : ''}}"><a href="/reward/completed/3"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li class="{{strpos(Request::path(),'reward/completed/4') !== false ? 'active' : ''}}"><a href="/reward/completed/4"><i class="fa fa-circle-o"></i> Level Four</a></li>
                    <li class="{{strpos(Request::path(),'reward/completed/5') !== false ? 'active' : ''}}"><a href="/reward/completed/5"><i class="fa fa-circle-o"></i> Level Five</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="{{Request::path() == 'unilevel' ? 'active' : ''}}"><a href="/unilevel"><i class="fa fa-sitemap"></i> <span>Unilevel</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield('content')
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">PHILSFOUREIGHT</a>.</strong>
      </footer>

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/app.min.js')}}"></script>
    @yield('scripts')
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
