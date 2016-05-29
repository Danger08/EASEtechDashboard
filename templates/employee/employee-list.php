<section class="content-header">
  

  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Employee list</h3>
        <div class="box-tools">
          <div class="input-group" style="width: 150px;">
            <input name="table_search" class="form-control input-sm pull-right" placeholder="Search for Employee" type="text" ng-model="SearchEmployee.$">
            <div class="input-group-btn">
              <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">

          <tbody><tr>
            <th>EASE Nickname</th>
            <th>Full name</th>
            <th>Shift</th>
            <th>Employee Type</th>
            <th>Position</th>
          </tr>

          <tr ng-repeat="Employee in allEmployees.data | filter : SearchEmployee :strict">
          
            <td>{{Employee.ease_nickname}}</td>
            <td><a href="#">{{Employee.ease_lname}}, {{Employee.ease_fname}}</a></td>
            <td>Morning Shift(Comming Soon)</td>
            <td><span class="label label-success">Regular(Comming Soon)</span></td>
            <td>Web Dev(Comming Soon)</td>

          </tr>
          <tr ng-show="loading==undefined;"><td></td><td></td><td><center> <i class="fa fa-spinner fa-pulse" ></i> Loading data please wait..</center></td><td></td><td></td></tr>
        </tbody></table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</section>