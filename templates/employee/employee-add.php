<section class="content-header">
<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Basic information</h3>
                  <button type="button" class="btn btn-primary pull-right" ng-click="addEmployee()">Save</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" class="form-inline" >
                     <div class="row">
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">Firstname</label>
                             <input type="text" class="form-control" id="firstname" placeholder="Juan" style="width:100%" ng-model="emp.firstname">
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">Middlename</label>
                             <input type="text" class="form-control" id="firstname" placeholder="Reyes" style="width:100%" ng-model="emp.middlename">
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">Lastname</label>
                             <input type="text" class="form-control" id="firstname" placeholder="Dela Cruz" style="width:100%" ng-model="emp.lastname">
                           </div>
                       </div>
                     </div>
                     <br>
                      <div class="row">
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">Address</label>
                             <input type="text" class="form-control" id="firstname" placeholder="Ark Building, Blas Ople Diversion Road, Malolos, 3000 Bulacan" style="width:100%" ng-model="emp.address">
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">Mobile</label>
                             <input type="text" class="form-control" id="firstname" placeholder="+63 943 4065 099" style="width:100%" ng-model="emp.mobile">
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">EASE Nickname</label>
                             <input type="text" class="form-control" id="firstname" placeholder="jdelacruz" style="width:100%" ng-model="emp.nickname">
                           </div>
                       </div>
                     </div>
                     <br>
                      <div class="row">
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">EASE Email</label>
                             <input type="text" class="form-control" id="firstname" placeholder="jdelacruz@easetechnologysolutions.com" style="width:100%" ng-model="emp.email">
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">EASE Username</label>
                             <input type="text" class="form-control" id="firstname" placeholder="jdelacruz" style="width:100%" ng-model="emp.username">
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group" style="width:100%">
                             <label for="firstname">EASE Password</label>
                             <input type="password" class="form-control" id="firstname" placeholder="Password" style="width:100%" ng-model="emp.password">
                           </div>
                       </div>
                     </div>

                  </form>
                  {{emp.nickname}} <br>
                  {{emp.firstname}}<br>
                  {{emp.middlename}}<br>
                  {{emp.lastname}}<br>
                  {{emp.address}}<br>
                  {{emp.email}}<br>
                  {{emp.mobile}}<br>
                  {{emp.username}}<br>
                  {{emp.password}}

                </div><!-- /.box-body -->
                <div class="overlay" ng-hide="loading==undefined">
              <i class="fa fa-spinner fa-pulse" ></i>
              </div>
              </div>
              </section>
          
              <div ng-controller="employeeCtrl">

    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header"><h3 class="modal-title"></h3>
        </div>
        <div class="modal-body" >
        <strong>
        {{message}}
        </strong>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
        </div>
</script>
