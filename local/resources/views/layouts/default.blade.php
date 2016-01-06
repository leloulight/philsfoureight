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
    <link rel="stylesheet" href="{{asset('dist/css/skins/skin-green.min.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('src/images/favicon.ico')}}"/>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a class="logo">
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
                  <span class="hidden-xs">{{ucfirst(strtolower(Auth::user()->firstname))}} {{ucfirst(strtolower(Auth::user()->lastname))}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{{asset('dist/img/default-user.png')}}" class="img-circle" alt="User Image">
                    <p>
                      {{ucfirst(strtolower(Auth::user()->firstname))}} {{ucfirst(strtolower(Auth::user()->lastname))}}
                      <small>Member since {{date_format(Auth::user()->created_at, "M d Y")}}</small>
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
                      <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
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
              <p>{{ucfirst(strtolower(Auth::user()->firstname))}} {{ucfirst(strtolower(Auth::user()->lastname))}}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{Request::path() == 'dashboard' ? 'active' : ''}}"><a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview {{strpos(Request::path(),'mynetwork') !== false ? 'active' : ''}}">
              <a href="::javascript()">
              <i class="fa fa-sitemap"></i> <span>My Network</span>
              <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu " style="">
                <li class="{{Request::path() == 'mynetwork/list' ? 'active' : ''}}"><a href="/mynetwork/list"><i class="fa fa-circle-o"></i> Network List</a></li>
                <li class="{{Request::path() == 'mynetwork/genealogy' ? 'active' : ''}}"><a href="/mynetwork/genealogy/{{Auth::user()->guid}}"><i class="fa fa-circle-o"></i> Genealogy</a></li>
              </ul>
            </li>          

            <!-- <li class="treeview {{strpos(Request::path(),'bills') !== false ? 'active' : ''}}">
              <a href="::javascript()">
              <i class="fa fa-money"></i> <span>Bills Payment</span>
              <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu " style="">
              <li class="{{strpos(Request::path(),'bills/1') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Telecoms <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'bills/1') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'bills/1/1') !== false ? 'active' : ''}}"><a href="/bills/1/1"><i class="fa fa-circle-o"></i> Globe Postpaid Plans</a></li>
                    <li class="{{strpos(Request::path(),'bills/1/2') !== false ? 'active' : ''}}"><a href="/bills/1/2"><i class="fa fa-circle-o"></i> Globelines</a></li>
                  </ul>
                </li>
                <li class="{{strpos(Request::path(),'bills/2') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Utilities <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'bills/2') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'bills/2/3') !== false ? 'active' : ''}}"><a href="/bills/2/3"><i class="fa fa-circle-o"></i> Maynilad Water</a></li>
                    <li class="{{strpos(Request::path(),'bills/2/4') !== false ? 'active' : ''}}"><a href="/bills/2/4"><i class="fa fa-circle-o"></i> My Destiny</a></li>
                    <li class="{{strpos(Request::path(),'bills/2/5') !== false ? 'active' : ''}}"><a href="/bills/2/5"><i class="fa fa-circle-o"></i> SkyCable</a></li>
                    <li class="{{strpos(Request::path(),'bills/2/6') !== false ? 'active' : ''}}"><a href="/bills/2/6"><i class="fa fa-circle-o"></i> SkyCable Zpdee</a></li>
                    <li class="{{strpos(Request::path(),'bills/2/7') !== false ? 'active' : ''}}"><a href="/bills/2/7"><i class="fa fa-circle-o"></i> South Cotabato II <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Electric Cooperative, Inc.</a></li>
                    <li class="{{strpos(Request::path(),'bills/2/8') !== false ? 'active' : ''}}"><a href="/bills/2/8"><i class="fa fa-circle-o"></i> Subic Water</a></li>
                    <li class="{{strpos(Request::path(),'bills/2/9') !== false ? 'active' : ''}}"><a href="/bills/2/9"><i class="fa fa-circle-o"></i> Visayan Electric Co., Inc.</a></li>
                  </ul>
                </li>
                <li class="{{strpos(Request::path(),'bills/3') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Loans <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'bills/3') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'bills/3/10') !== false ? 'active' : ''}}"><a href="/bills/3/10"><i class="fa fa-circle-o"></i> Chinatrust Salary Stretch</a></li>
                    <li class="{{strpos(Request::path(),'bills/3/11') !== false ? 'active' : ''}}"><a href="/bills/3/11"><i class="fa fa-circle-o"></i> Citibank Savings</a></li>
                    <li class="{{strpos(Request::path(),'bills/3/12') !== false ? 'active' : ''}}"><a href="/bills/3/12"><i class="fa fa-circle-o"></i> Citifinancial</a></li>
                    <li class="{{strpos(Request::path(),'bills/3/13') !== false ? 'active' : ''}}"><a href="/bills/3/13"><i class="fa fa-circle-o"></i> City State Bank Loan</a></li>
                    <li class="{{strpos(Request::path(),'bills/3/14') !== false ? 'active' : ''}}"><a href="/bills/3/14"><i class="fa fa-circle-o"></i> Equicom Savings</a></li>
                    <li class="{{strpos(Request::path(),'bills/3/15') !== false ? 'active' : ''}}"><a href="/bills/3/15"><i class="fa fa-circle-o"></i> HSBC Loan</a></li>
                    <li class="{{strpos(Request::path(),'bills/3/16') !== false ? 'active' : ''}}"><a href="/bills/3/16"><i class="fa fa-circle-o"></i> PSBank</a></li>
                    <li class="{{strpos(Request::path(),'bills/3/17') !== false ? 'active' : ''}}"><a href="/bills/3/17"><i class="fa fa-circle-o"></i> Standard Chartered <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; EX Loan</a></li>
                  </ul>
                </li>
                <li class="{{strpos(Request::path(),'bills/4') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Insurances <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'bills/4') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'bills/4/18') !== false ? 'active' : ''}}"><a href="/bills/4/18"><i class="fa fa-circle-o"></i> Ayala Life</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/19') !== false ? 'active' : ''}}"><a href="/bills/4/19"><i class="fa fa-circle-o"></i> AXA Life</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/20') !== false ? 'active' : ''}}"><a href="/bills/4/20"><i class="fa fa-circle-o"></i> Cocolife</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/21') !== false ? 'active' : ''}}"><a href="/bills/4/21"><i class="fa fa-circle-o"></i> Danvil Plans/Berkley <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; International Plans</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/22') !== false ? 'active' : ''}}"><a href="/bills/4/22"><i class="fa fa-circle-o"></i> Great Financial</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/23') !== false ? 'active' : ''}}"><a href="/bills/4/23"><i class="fa fa-circle-o"></i> Fortune Care</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/24') !== false ? 'active' : ''}}"><a href="/bills/4/24"><i class="fa fa-circle-o"></i> Fortune Life</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/25') !== false ? 'active' : ''}}"><a href="/bills/4/25"><i class="fa fa-circle-o"></i> Manulife</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/26') !== false ? 'active' : ''}}"><a href="/bills/4/26"><i class="fa fa-circle-o"></i> Paramount Life</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/27') !== false ? 'active' : ''}}"><a href="/bills/4/27"><i class="fa fa-circle-o"></i> Pioneer Life</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/28') !== false ? 'active' : ''}}"><a href="/bills/4/28"><i class="fa fa-circle-o"></i> PNB Life</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/29') !== false ? 'active' : ''}}"><a href="/bills/4/29"><i class="fa fa-circle-o"></i> Philamlife</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/30') !== false ? 'active' : ''}}"><a href="/bills/4/30"><i class="fa fa-circle-o"></i> Pru Life U.K.</a></li>
                    <li class="{{strpos(Request::path(),'bills/4/31') !== false ? 'active' : ''}}"><a href="/bills/4/31"><i class="fa fa-circle-o"></i> Sun Life of Canada <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Phils.), Inc.</a></li>
                  </ul>
                </li>
                <li class="{{strpos(Request::path(),'bills/5') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Credit Card <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'bills/5') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'bills/5/32') !== false ? 'active' : ''}}"><a href="/bills/5/32"><i class="fa fa-circle-o"></i> Allied Bank</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/33') !== false ? 'active' : ''}}"><a href="/bills/5/33"><i class="fa fa-circle-o"></i> Bankard</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/34') !== false ? 'active' : ''}}"><a href="/bills/5/34"><i class="fa fa-circle-o"></i> BDO</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/35') !== false ? 'active' : ''}}"><a href="/bills/5/35"><i class="fa fa-circle-o"></i> Citibank</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/36') !== false ? 'active' : ''}}"><a href="/bills/5/36"><i class="fa fa-circle-o"></i> EastWest Bank</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/37') !== false ? 'active' : ''}}"><a href="/bills/5/37"><i class="fa fa-circle-o"></i> HSBC</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/38') !== false ? 'active' : ''}}"><a href="/bills/5/38"><i class="fa fa-circle-o"></i> Metrobank / PSBank</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/39') !== false ? 'active' : ''}}"><a href="/bills/5/39"><i class="fa fa-circle-o"></i> PNB</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/40') !== false ? 'active' : ''}}"><a href="/bills/5/40"><i class="fa fa-circle-o"></i> Security Bank Diners</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/41') !== false ? 'active' : ''}}"><a href="/bills/5/41"><i class="fa fa-circle-o"></i> Security Bank Mastercard</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/42') !== false ? 'active' : ''}}"><a href="/bills/5/42"><i class="fa fa-circle-o"></i> Standard Chartered</a></li>
                    <li class="{{strpos(Request::path(),'bills/5/43') !== false ? 'active' : ''}}"><a href="/bills/5/43"><i class="fa fa-circle-o"></i> Union Bank</a></li>
                  </ul>
                </li>
                <li class="{{strpos(Request::path(),'bills/6') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Others <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'bills/6') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'bills/6/44') !== false ? 'active' : ''}}"><a href="/bills/6/44"><i class="fa fa-circle-o"></i> Church of Jesus <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Christ of LDS</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/45') !== false ? 'active' : ''}}"><a href="/bills/6/45"><i class="fa fa-circle-o"></i> Convoy</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/46') !== false ? 'active' : ''}}"><a href="/bills/6/46"><i class="fa fa-circle-o"></i> DTI</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/47') !== false ? 'active' : ''}}"><a href="/bills/6/47"><i class="fa fa-circle-o"></i> Easy Trip</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/48') !== false ? 'active' : ''}}"><a href="/bills/6/48"><i class="fa fa-circle-o"></i> E-Pass</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/49') !== false ? 'active' : ''}}"><a href="/bills/6/49"><i class="fa fa-circle-o"></i> GT Parking</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/50') !== false ? 'active' : ''}}"><a href="/bills/6/50"><i class="fa fa-circle-o"></i> IC Parking</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/51') !== false ? 'active' : ''}}"><a href="/bills/6/51"><i class="fa fa-circle-o"></i> Jet Star Airlines</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/52') !== false ? 'active' : ''}}"><a href="/bills/6/52"><i class="fa fa-circle-o"></i> Kikoload</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/53') !== false ? 'active' : ''}}"><a href="/bills/6/53"><i class="fa fa-circle-o"></i> National Quality <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Corporation</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/54') !== false ? 'active' : ''}}"><a href="/bills/6/54"><i class="fa fa-circle-o"></i> NSO Helpline Pluss</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/55') !== false ? 'active' : ''}}"><a href="/bills/6/55"><i class="fa fa-circle-o"></i> SSS</a></li>
                    <li class="{{strpos(Request::path(),'bills/6/56') !== false ? 'active' : ''}}"><a href="/bills/6/56"><i class="fa fa-circle-o"></i> Sumisho</a></li>
                  </ul>
                </li>
                <li class="{{strpos(Request::path(),'bills/7') !== false ? 'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Schools <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu" style="{{strpos(Request::path(),'bills/7') !== false ? 'display: block;' : ''}}">
                    <li class="{{strpos(Request::path(),'bills/7/57') !== false ? 'active' : ''}}"><a href="/bills/7/57"><i class="fa fa-circle-o"></i> UP</a></li>
                    <li class="{{strpos(Request::path(),'bills/7/58') !== false ? 'active' : ''}}"><a href="/bills/7/58"><i class="fa fa-circle-o"></i> La Salle</a></li>
                    <li class="{{strpos(Request::path(),'bills/7/59') !== false ? 'active' : ''}}"><a href="/bills/7/59"><i class="fa fa-circle-o"></i> Miriam College</a></li>
                    <li class="{{strpos(Request::path(),'bills/7/60') !== false ? 'active' : ''}}"><a href="/bills/7/60"><i class="fa fa-circle-o"></i> UST</a></li>
                    <li class="{{strpos(Request::path(),'bills/7/61') !== false ? 'active' : ''}}"><a href="/bills/7/61"><i class="fa fa-circle-o"></i> San Beda</a></li>
                    <li class="{{strpos(Request::path(),'bills/7/62') !== false ? 'active' : ''}}"><a href="/bills/7/62"><i class="fa fa-circle-o"></i> San Sebastian</a></li>
                  </ul>
                </li>
              </ul>
            </li>
 -->
            <!-- <li class="{{Request::path() == 'remittance' ? 'active' : ''}}"><a href="/remittance"><i class="fa fa-send"></i> <span>Remittance Service</span></a></li> -->

            <li class="treeview {{strpos(Request::path(),'register') !== false ? 'active' : ''}}">
              <a href="::javascript()">
              <i class="fa fa-history"></i> <span>Transaction History</span>
              <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu " style="">
                <li class="{{Request::path() == 'register' ? 'active' : ''}}"><a href="/history/commission"><i class="fa fa-circle-o"></i> Commission</a></li>
                <!-- <li class="{{Request::path() == 'register/sub' ? 'active' : ''}}"><a href=""><i class="fa fa-circle-o"></i> Encashment</a></li>
                <li class="{{Request::path() == 'register/stockist' ? 'active' : ''}}"><a href=""><i class="fa fa-circle-o"></i> Bills Payment</a></li>
                <li class="{{Request::path() == 'register/stockist' ? 'active' : ''}}"><a href=""><i class="fa fa-circle-o"></i> Remittance</a></li> -->
              </ul>
            </li>

            <li class="treeview {{strpos(Request::path(),'register') !== false ? 'active' : ''}}">
              <a href="::javascript()">
              <i class="fa fa-group"></i> <span>Sub Account</span>
              <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu " style="">
                <li class="{{Request::path() == 'register' ? 'active' : ''}}"><a href=""><i class="fa fa-circle-o"></i> Add Sub Account</a></li>
                <li class="{{Request::path() == 'register/sub' ? 'active' : ''}}"><a href=""><i class="fa fa-circle-o"></i> View List</a></li>
              </ul>
            </li>

            <li class="treeview {{strpos(Request::path(),'register') !== false ? 'active' : ''}}">
              <a href="::javascript()">
              <i class="fa fa-gear"></i> <span>Profile</span>
              <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu " style="">
                <li class="{{Request::path() == 'register' ? 'active' : ''}}"><a href=""><i class="fa fa-circle-o"></i> View Info</a></li>
              </ul>
            </li>
            <!-- <li class="{{Request::path() == 'unilevel' ? 'active' : ''}}"><a href="/unilevel"><i class="fa fa-sitemap"></i> <span>Unilevel</span></a></li> -->
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
    <script src="{{asset('dist/js/loader.js')}}"></script>
    <script type="text/javascript">
    </script>
    @yield('scripts')
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
