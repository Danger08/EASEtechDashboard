<?php

session_name('LoginForm');
@session_start();
?>
<section class="content-header">
  <h1>
    Task
    <small> Information </small>
  </h1>
</section>
<section class="content">



  <div class="row" ng-init='getInfo(<?PHP echo json_encode($_SESSION["user_info"]);?>)'>
    {{taskfront}}
    <!-- left column -->
    <div class="col-md-12">
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
          <p class="text-muted"style="padding-left:2em;">{{parseAssignee(singletaskinfo.task_assignee)}}</p>
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

      </div>
      <?PHP echo json_encode($_SESSION['user_info']);?>
    </section>

    <style type="text/css">
    .table-condensed > thead > tr > th {
      padding:8px !important;
    }
    </style>