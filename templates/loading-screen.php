
 <?php

session_name('LoginForm');
@session_start();


?>

    <!-- Main content -->
    <section class="content" ng-init='getInfo(<?PHP echo json_encode($_SESSION["user_info"]);?>)'>

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            
        </div>
        <!-- /.box-body -->

        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </section>
