<?php

session_name('LoginForm');
@session_start();

error_reporting(0);
include("config.php");

?>

<!DOCTYPE html>
<html ng-app="EASEDashboard">
  <head>
    <base href="index.php">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="57x57" href="img/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/fav/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>EASE | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="js/chat/chatstyle.css" rel="stylesheet">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

    <link rel="stylesheet" href="lib/angular-ui-notification/dist/angular-ui-notification.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
   <?php if(isset($_SESSION['user_info']) && is_array($_SESSION['user_info'])) { ?>
  <body class="hold-transition skin-red-light sidebar-mini" ng-init="userid=<?PHP echo $_SESSION['user_info']['ease_id'] ?>">


    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>EA</b>SE</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>EASE</b>Dashboard</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="img/avatar/<?PHP echo $_SESSION['user_info']['ease_nickname'];?>.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?PHP echo $_SESSION['user_info']['ease_fname']." ".$_SESSION['user_info']['ease_lname']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="img/avatar/<?PHP echo $_SESSION['user_info']['ease_nickname'];?>.jpg" class="img-circle" alt="User Image">
                    <p><?PHP echo $_SESSION['user_info']['ease_fname']." ".$_SESSION['user_info']['ease_lname']; ?>
                      <small><?PHP echo $_SESSION['user_info']['ease_email'] ?></small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="/app/login.php?ac=logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li ng-app="EASEDashboard" >
                <a href="" data-toggle="control-sidebar"><i class="fa fa-comments"></i></a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="img/avatar/<?PHP echo $_SESSION['user_info']['ease_nickname'];?>.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?PHP echo $_SESSION['user_info']['ease_fname']." ".$_SESSION['user_info']['ease_lname']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input name="q" class="form-control" placeholder="Search..." type="text">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
      <?PHP

      switch($_SESSION['user_info']['ease_role']){
        case 0 :
        require 'templates/sidebar/zero.php';

        break;
        case 1 :
        require 'templates/sidebar/one.php';

        break;
        case 2:
        require 'templates/sidebar/two.php';

        break;
        case 3:

        require 'templates/sidebar/three.php';
        break;
      }

      ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <div ui-view>

        </div>

      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.0.1
        </div>
        <strong>Copyright &copy; 2016 <a href="http://easetechnologysolutions.com">EASE Technology Solution</a>.</strong> All rights reserved.
      </footer>

      <?PHP require_once('templates/chat/chatlist.php');?>
    </div><!-- ./wrapper -->

        <script src="css/plugins/jQuery/jQuery-2.2.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="css/plugins/fastclick/fastclick.min.js"></script>
        <script src="css/dist/js/app.min.js"></script>
        <script src="css/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="css/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="css/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="css/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="css/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="css/plugins/chartjs/Chart.min.js"></script>
        <script src="css/dist/js/demo.js"></script>
        <script type="text/javascript" src="js/desktop-notify-min.js"></script>

    <script src="js/angular/angular.min.js"></script>
    <script src="js/angular/angular-animate.min.js"></script>
        <script src="js/ui-bootstrap-tpls-1.3.2.min.js"></script>
    <script src="js/angular/angular-ui-router.min.js"></script>
    <script src="lib/angular-cache/dist/angular-cache.min.js"></script>
    <script src="lib/bknd/dist/backand.min.js"></script>
    <script src="//cdn.backand.net/backand/dist/1.8.2/backand.debug.js"></script>
    <script src="https://api.backand.com:4000/socket.io/socket.io.js"></script>
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/services.js"></script>

<?php } else { header("Location: login.php"); exit;?>

 <?php } ?>
  </body>
</html>
