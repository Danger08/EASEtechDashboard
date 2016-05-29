<?php

session_name('LoginForm');
@session_start();

if($_SESSION['user_info']['ease_role']>2){
  require("../denied.php");
}else{?>
  <section class="content-header">
    <h1>
      Task
      <small> Information </small>
    </h1>
  </section>
  <section class="content">

    <div ng-init='getInfo(<?PHP echo json_encode($_SESSION["user_info"]);?>)'></div>

    <div class="row">
      {{taskfront}}
      <!-- left column -->
      <div class="col-md-5">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"> {{singletaskinfo.task_name}} </h3> <br><span class="label label-primary">{{singletaskinfo.task_priority}}</span>  <span class="label label-success">{{parseStatus(singletaskinfo.task_status)}}</span>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Category</strong>

            <p class="text-muted">
              {{singletaskinfo.task_tags}}
            </p>

            <strong><i class="fa fa-map-marker margin-r-5"></i>Desciption</strong>

            <p class="text-muted"><pre>{{singletaskinfo.task_description}}</pre></p>

            <hr>

            <strong><i class="fa fa-pencil margin-r-5"></i> Other information </strong>
            <br>
            <strong style="padding-left:2em;padding-top:2em;"><i class="fa fa-map-marker margin-r-5"></i> Start/Due Date </strong>
            <p class="text-muted"style="padding-left:2em;">Start date : {{parseDate(singletaskinfo.task_start)}}<br>Due date : {{parseDate(singletaskinfo.task_due)}}</p>
            <br>
            <strong style="padding-left:2em;"><i class="fa fa-map-marker margin-r-5"></i> Task Assignee </strong>
            <p class="text-muted"style="padding-left:2em;">{{taskAssignee.ease_nickname}}</p>
            <br>
            <strong style="padding-left:2em;"><i class="fa fa-map-marker margin-r-5"></i> Project ID </strong>
            <p class="text-muted"style="padding-left:2em;">{{singletaskinfo.task_id}}</p>



          </div>
          <div class="overlay" ng-show="taskdataloading == undefined">
            <i class="fa fa-spinner fa-pulse" ></i>
          </div>
          <!-- /.box-body -->

        </div>



      </div>
        <!--/.col (left) --abc123>
        <!-- right column -->
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" ng-submit="">
              <div class="box-body">

                <div class="form-group">
                  <label for="tasknameinput">Task Assignee</label><!--{{taskAssignee}}-->
                  <select name="" class="form-control"  ng-options="item.ease_nickname for item in empData track by item.ease_id" ng-model="taskAssignee">


                  </select>
                </div>
                <div class="form-group">
                  <label for="tasknameinput">Task Name</label><!--{{taskName}}-->
                  <input class="form-control" id="tasknameinput" type="text" value="{{singletaskinfo.task_name}}" ng-model="taskName">
                </div>
                <div class="form-group">
                  <label for="taskdescriptioninput">Task Description</label>
                  <textarea name="" style="height: auto; width: 100%;" id="taskdescriptioninput" ng-model="taskDescription">{{singletaskinfo.task_description}}</textarea>
                </div>
                <div class="form-group">
                  <label >Priority</label><!--{{taskPriority.name}}-->
                  <select name="" class="form-control" ng-options="item.name for item in prioritySelectValue" ng-model="taskPriority">
                  </select>

                </div>
                <div class="form-group">
                  <label >Task Status</label><!--{{taskStatus.value}}-->
                  <select name="" class="form-control" ng-options="item.name for item in statusSelectValue" ng-model="taskStatus">
                  </select>

                </div>
                <div class="form-group" >
                  <label >Task Category</label><!--{{taskTags.name}}-->
                  <select name="" class="form-control" ng-options="item.name for item in tagsSelectValue" ng-model="taskTags">

                  </select>
                </div>
                <div class="form-group" id="sandbox-container">
                  <label for="exampleInputPassword1">Start Date</label><!--{{task.Start}}-->
                  <div class="input-group">
                    <input type="text" class="form-control" uib-datepicker-popup ng-model="taskStart" is-open="popup1.opened" popup-placement="top-left" min-date="minDate" max-date="maxDate" datepicker-options="dateOptions" date-disabled="disabled(date, mode)" ng-required="true" close-text="Close" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
                    </span>
                  </div>
                </div>

                <div class="form-group" id="sandbox-container">
                  <label for="exampleInputPassword1">Due Date</label><!--{{task.Due}}-->
                  <div class="input-group">
                    <input type="text" class="form-control"  uib-datepicker-popup ng-model="taskDue" is-open="popup2.opened" popup-placement="top-left" min-date="minDate" max-date="maxDate" datepicker-options="dateOptions" date-disabled="disabled(date, mode)" ng-required="true" close-text="Close"  />
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default" ng-click="open2()"><i class="glyphicon glyphicon-calendar"></i></button>
                    </span>
                  </div>
                  <!-- /.box-body -->
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" ng-click="updateTaskInfo()">Submit</button>
                </div>
              </form>

            </div>
<div class="overlay" ng-show="taskdataloading == undefined">
                <i class="fa fa-spinner fa-pulse"></i>
              </div>
            <!-- /.box -->
          </div>
          <!--/.col (right) -->
        </div>
      </section>

      <style type="text/css">
        .table-condensed > thead > tr > th {
          padding:8px !important;
        }
      </style>
      <?PHP } ?>
