<?php

session_name('LoginForm');
@session_start();

error_reporting(0);
include("config.php");

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EASE Technology Solutions| Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="css/plugins/iCheck/square/blue.css">

 <style type="text/css" media="screen">
   .login-box-body {
    box-shadow: 0px 3px 10px rgb(136, 136, 136);
   }
   .login-logo {
    font-size: 25px;
   }
 </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

      </head>
      <body class="hold-transition login-page" ng-app>

    <div class="login-box"  >
          <div class="login-logo">
            <img src="img/logo.png" alt="" height="90px" width="90px">
            <a href="#"><b>Technology Solutions</b> </a>
          </div><!-- /.login-logo -->
             <div class="login-box-body">
             <p class="login-box-msg">Sign in to start your session</p>
<?php
  $error = '';
  if(isset($_POST['is_login']) && isset($_POST['submit'])){
    $sql = "SELECT `ease_id`,`ease_nickname`,`ease_fname`,`ease_lname`,`ease_address`,`ease_email`,`ease_mobile`,`ease_role`,`ease_username`,`last_login`,`ease_mname` FROM ". $SETTINGS["USERS"]." WHERE `ease_username` = '".mysql_real_escape_string($_POST['username'])."' AND `ease_password` = md5(SHA2('".mysql_real_escape_string($_POST['password'])."',512))";
    $sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
    $user = mysql_fetch_assoc($sql_result);
    echo mysql_fetch_assoc($sql_result);
    if(!empty($user)){
      $_SESSION['user_info'] = $user;
      $query = " UPDATE ".$SETTINGS["USERS"]." SET last_login = NOW() WHERE ease_id=".$user['ease_id'];
      mysql_query ($query, $connection ) or die ('request "Could not execute SQL query" '.$query);

    }
    else{
      $error = 'Invalid username or password.';
    }
  }

  if(isset($_GET['ac']) && $_GET['ac'] == 'logout'){
    $_SESSION['user_info'] = null;
    unset($_SESSION['user_info']);
    $_SESSION['user_clockin'] = null;
    unset($_SESSION['user_clockin']);
  }
?>
  <?php

    if(isset($_POST['clockin'])){

      $sql = "SELECT `ease_id`,`ease_nickname`,`ease_fname`,`ease_lname`,`ease_address`,`ease_email`,`ease_mobile`,`ease_role`,`ease_username`,`last_login`,`ease_mname` FROM ". $SETTINGS["USERS"]." WHERE `ease_username` = '".mysql_real_escape_string($_POST['username'])."' AND `ease_password` = md5(SHA2('".mysql_real_escape_string($_POST['password'])."',512))";
      $sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
      $userclockin = mysql_fetch_assoc($sql_result);
      echo mysql_fetch_assoc($sql_result);
      if(!empty($userclockin)){
        $_SESSION['user_clockin'] = $userclockin;
        $query = " UPDATE ".$SETTINGS["USERS"]." SET last_login = NOW() WHERE ease_id=".$userclockin['ease_id'];
        mysql_query ($query, $connection ) or die ('request "Could not execute SQL query" '.$query);

      }
      else{
        $error = 'Invalid username or password.';
      }
    }

  ?>
  <?php if(isset($_SESSION['user_info']) && is_array($_SESSION['user_info'])) {
    header("Location: index.php");
    exit;
    ?>



          <?php echo json_encode($_SESSION['user_info']);echo $_SESSION['user_info']['ease_fname']  ?>, you are logged in.
                    <br /><br />
                    <?php echo $_SESSION['user_info']['content']  ?>
                    <br /><br />
                    <a href="login.php?ac=logout" style="color:#3ec038">Logout</a>

      </form>

  <?php } else { ?>
      <form id="login-form" class="login-form" name="form1" method="post" action="login.php">
        <input type="hidden" name="is_login" value="1">
          <div id="form-content">
                <div class="form-group has-feedback">
              <input id="username" name="username" class="form-control required" type="text" placeholder="Username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>


              <div class="form-group has-feedback">
                <input id="password" name="password" class="form-control required" type="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <?php if($error) { ?>
                  <em>
            <label class="err" for="password" generated="true" style="display: block;"><?php echo $error ?></label>
          </em>
        <?php } ?>
              <div class="group submit">
                  <label class="empty"></label>
                  <div>
                  <!-- <button type="button" class="btn btn-danger btn-block btn-flat btn-lg" data-toggle="modal" data-target="#myModal">Clock in</button>
                  <input name="clockin" type="submit" value="Clock in" class="btn btn-primary btn-block btn-flat btn-lg "/></div> -->
                  <input name="submit" type="submit" value="Submit" class="btn btn-primary btn-block btn-flat btn-lg"/></div>
              </div>
          </div>
          <div id="form-loading" class="hide"><i class="fa fa-circle-o-notch fa-spin"></i></div>
      </form>
          </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  <?php } ?>
      <script src="js/webcam/webcam.js"></script>
      <!-- jQuery 2.1.4 -->
      <script src="css/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script src="js/jquery.validate.min.js"></script>
      <script src="js/main.js"></script>
      <!-- Bootstrap 3.3.5 -->
      <script src="css/bootstrap/js/bootstrap.min.js"></script>
      <!-- iCheck -->
      <script src="css/plugins/iCheck/icheck.min.js"></script>


          <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            <?php
            if(isset($_SESSION['user_clockin']) && is_array($_SESSION['user_clockin'])) {
              echo print_r($_SESSION['user_clockin']);
            }?>

            <center><div id="my_camera" style="width:320px; height:240px;"></div>
              <div id="my_result"></div></center>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a class="btn btn-danger" href="javascript:void(take_snapshot())" role="button">Clock in</a>
            </div>
          </div>
        </div>
      </div> <!-- Modal end -->
      <?php
      if(isset($_SESSION['user_clockin']) && is_array($_SESSION['user_clockin'])) { ?>
        <script type="text/javascript">
             jQuery(document).ready(function(){
                 jQuery('#myModal').modal('show');
             });
            </script>
        <?php echo json_encode($_SESSION['user_clockin']); } ?>
      <script>
        jQuery(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
        });
        jQuery(document).ready('#myModal').on('shown.bs.modal', function (e) {
          Webcam.attach( '#my_camera' );
        })
        function take_snapshot() {
            Webcam.snap( function(data_uri) {
              document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';

            } );
          }
      </script>
    </body>
    </html>
