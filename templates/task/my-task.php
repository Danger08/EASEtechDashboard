<?php

session_name('LoginForm');
@session_start();
?>


<div ng-init='getInfo(<?PHP echo json_encode($_SESSION["user_info"]);?>)'></div>
 <section class="content-header">
          <h1>
            Task 
            <small> All </small>
          </h1>
</section>

<section class="content" >
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Task Categories  </h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
              <li><a ui-sref="mytasks({taskstatus: 'All'})"><i class="fa fa-tasks"></i>All</a></li>
                <li><a ui-sref="mytasks({taskstatus: 'Created'})"><i class="fa fa-tasks"></i>Created</a></li>
                <li><a ui-sref="mytasks({taskstatus: 'inProgress'})"><i class="fa fa-tasks"></i>In Progress</a></li>
                <li><a ui-sref="mytasks({taskstatus: 'Completed'})"><i class="fa fa-tasks"></i>Completed</a></li>
                <li><a ui-sref="mytasks({taskstatus: 'onHold'})"><i class="fa fa-tasks"></i>On Hold</a></li>
                <li><a ui-sref="mytasks({taskstatus: 'Cancelled'})"><i class="fa fa-tasks"></i> Cancelled</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>
              
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{parseStatus(taskstatus)}} <span class="badge bg-aqua">{{ taskdata.length }}</span></h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input class="form-control input-sm" placeholder="Search Task" type="text" ng-model="SearchTask.$"> 
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                 
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr ng-repeat="task in taskdata | orderBy : '-task_id' | filter : SearchTask :strict" class="animate-show">
                    <td><div aria-disabled="false" aria-checked="false" style="position: relative;" class="icheckbox_flat-blue"><input style="position: absolute; opacity: 0;" type="checkbox"><ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" class="iCheck-helper"></ins></div></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-blue"></i></a></td>
                    <td class="mailbox-name"><a ui-sref="mytask({taskid: task.task_id})">{{task.task_name}}</a></td>
                    <td class="mailbox-subject"> {{cutString(36,task.task_description)}}
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">5 mins ago</td>
                  </tr>
                    <tr ng-show="loading==undefined;"><td><center> <i class="fa fa-spinner fa-pulse" ></i> Loading data please wait..</center></td></tr>
                    <tr ng-show="taskdata.length < 1"><td><center>No Items found in this category</center></td></tr>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  {{ taskdata.length }} 
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?PHP echo json_encode($_SESSION['user_info']);?>
   </section>