


<section class="content-header">
  <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
              <form class="form-inline">

              <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group" style="width: 100%;">
                <label for="client">Client</label><br>
                <select style="width: 100%;" class="form-control ng-pristine ng-valid ng-touched" style="margin-bottom: 10px;" ng-init="option[0]"ng-options="option.firstname + ' ' + option.lastname for option in useroptions" ng-model="invoice.selecteduserdata" ng-change="getAppUsersTasks(invoice.selecteduserdata.ease_userid)";></select>
                </div>
              </div> -->
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="Date">Date Created</label><br>
                  <p class="input-group">

                     <input type="text" class="form-control" uib-datepicker-popup="MM/dd/yyyy" ng-model="invoice.date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" />
                     <span class="input-group-btn">
                       <button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
                     </span>
                   </p>
                </div>
              </div>
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <label for="Date">Payment Due</label><br>
                  <p class="input-group">

                     <input type="text" class="form-control" uib-datepicker-popup="MM/dd/yyyy" ng-model="invoice.due" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" />
                     <span class="input-group-btn">
                       <button type="button" class="btn btn-default" ng-click="open2()"><i class="glyphicon glyphicon-calendar"></i></button>
                     </span>
                   </p>
                </div>
              </div>
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                  <label>Status {{invoice.invoicestatus.value}}</label><br>
                  <select class="form-control" ng-model="invoice.invoicestatus" ng-options="status.name for status in statusOptions track by status.value">

                  </select>
                </div>
              </div>

              </form>


            </div>
          </div>
            <!-- /.info-box-content -->
    </div>
  </div>
  <div ng-init="loadEditData()">

  </div>
  <section class="invoice ">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> EASE Technology Solutions
            <small class="pull-right">Date: {{invoice.date | date : 'MM/dd/yyyy'}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>EASE Technology Solutions, Inc.</strong><br>
            Bulihan , Malolos City 3000<br>
            Philippines<br>
            Phone: (804) 123-5432<br>
            Email: info@easetechnologysolutions.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{invoice.selecteduserdata.firstname}} {{invoice.selecteduserdata.lastname}}</strong><br>
            <p style="height:80px;width:200px">
              {{invoice.selecteduserdata.address}}<br>
              {{invoice.selecteduserdata.mobile}}<br>
              {{invoice.selecteduserdata.email}}
            </p>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice </b>ETS - <span ng-show="invoiceid!=undefined">{{invoiceid}}</span><br>
          <b>Payment Due:</b> {{invoice.due | date : 'MM/dd/yyyy'}}<br>
          <b>Client ID:</b> {{invoice.selecteduserdata.ease_userid}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>

                <th>Name</th>
                <th>Description</th>
                <th>Subtotal</th>
                <th><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button></th>
              </tr>
            </thead>
            <tbody>

            <tr ng-repeat="item in invoiceitem">
              <td>{{item.name}}</td>
              <td>{{item.description}}</td>
              <td>{{item.price}}</td>
              <td><button type="button" class="btn btn-danger" ng-click="removeInvoiceitem($index,item.object)"><i class="fa fa-times"></i></button></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods: <button type="button" class="btn btn-info" data-toggle="modal" data-target="#paymentModal"><i class="fa fa-plus"></i></button></p>
            <span ng-repeat="paymentmethod in paymentmethodlist" style="max-width:64px;">
            <a href="{{paymentmethod.link}}" target="_blank"  >
                <img src="img/paymentimg/{{paymentmethod.gateway}}.png" alt="{{paymentmethod.gateway}}" height="40px" width="auto">
            </a>
            <a type="button" class="btn btn-danger btn-xs" style="max-width: 64px;" ng-click="removePaymentMethod($index)"> <i class="fa fa-times" aria-hidden="true"></i></a>
            </span>

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due {{invoice.due | date : 'MM/dd/yyyy'}}</p>

          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                <th>Total:</th>
                <td>$ {{invoiceitemtotal}}</td>

              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a ng-click="previewInvoice(invoice.date,invoice.due,invoice.selecteduserdata,invoiceitem,paymentmethodlist,'print')" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button  class="btn btn-default" ng-click="previewInvoice(invoice.date,invoice.due,invoice.selecteduserdata,invoiceitem,paymentmethodlist,'preview')"><i class="fa fa-print" ></i> Preview </button>
          <button type="button" class="btn btn-success pull-right" ng-click="updateInvoice(invoice.selecteduserdata.ease_userid,invoicetobeEdited.invoice_id,invoice.date,invoice.due,invoice.selecteduserdata,invoiceitem,paymentmethodlist,invoice.invoicestatus.value)" ng-show="updatinginvoice===undefined"><i class="fa fa-credit-card"></i> Update Invoice
          </button>
          <button type="button" class="btn btn-success pull-right disabled" ng-show="updatinginvoice!=undefined"><i class="fa fa-spinner fa-pulse"></i> Updating invoice
          </button>
          <a ng-click="previewInvoice(invoice.date,invoice.due,invoice.selecteduserdata,invoiceitem,paymentmethodlist,'pdf')" class="btn btn-primary pull-right" style="margin-right: 5px;" target="_blank">
            <i class="fa fa-download"></i> Generate PDF
          </a>
        </div>
      </div>
    </section>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button on type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Items</h4>
      </div>
      <div class="modal-body">
        <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href data-target="#tasklist" aria-controls="tasklist" role="tab" data-toggle="tab">From users task list</a></li>
    <li role="presentation"><a href data-target="#manuallist" aria-controls="manuallist" role="tab" data-toggle="tab">Manually Enter</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tasklist">
      <div class="form-group">
        <br>
    <h4 style="color:red" ng-show="invoiceitemerror!=undefined">{{invoiceitemerror}}</h4>
   <select class="form-control" ng-model="invoice.selectedtaskadd" ng-options="option.task_name for option in taskoptions ">

   </select>
   <b>Information</b><br>
    <b>"task_id" </b>: {{invoice.selectedtaskadd.task_id}} <br>
    <b>"task_name" </b>:  {{invoice.selectedtaskadd.task_name}}<br>
    <b>"task_description"  </b>: {{invoice.selectedtaskadd.task_description}}<br>
    <b>"task_start" </b>:  {{invoice.selectedtaskadd.task_start | date : 'MM/dd/yyyy'}}<br>
    <b>"task_due" </b>:  {{invoice.selectedtaskadd.task_due | date : 'MM/dd/yyyy'}}<br>
    <b>"task_category" </b>:  {{invoice.selectedtaskadd.task_tags}}<br>
    <b>"task_assignee" </b>: {{invoice.selectedtaskadd.task_assignee}}<br>
    <b>"task_priority" </b>:  {{invoice.selectedtaskadd.task_priority}}<br>
    <b>"task_status" </b>: {{invoice.selectedtaskadd.task_status}}<br>
    <br>
    <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                <input class="form-control"  placeholder="Enter Subtotal" type="text" ng-model="invoice.tasklist.price">
    </div>
  <button type="button" class="btn btn-primary btn-block" ng-click="addtoinvoiceitem(invoice.selectedtaskadd.task_name,invoice.selectedtaskadd.task_description,invoice.tasklist.price,invoice.selectedtaskadd)">Add</button>

 </div>

    </div>
    <div role="tabpanel" class="tab-pane" id="manuallist">
      <br>

      <div class="form-group">
                  <label for="exampleInputEmail1">Item name</label>
                  <input class="form-control"  placeholder="Enter Item name" type="text" ng-model="invoice.manual.name">
      </div>
      <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input class="form-control"  placeholder="Enter Description" type="text" ng-model="invoice.manual.desc">
      </div>

      <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input class="form-control"  placeholder="Enter Subtotal" type="text" ng-model="invoice.manual.price">
      </div>
      <br>
      <button type="button" class="btn btn-primary btn-block" ng-click="addtoinvoiceitemmanual(invoice.manual.name,invoice.manual.desc,invoice.manual.price)">Add</button>
    </div>
  </div>

</div>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="paymentModalLabel">Add payment links</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
                  <label>Payment method</label>
                  <select class="form-control" ng-model="invoice.paymentmethod">
                    <option default>Payoneer</option>
                    <option>Paypal</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="URL">URL</label>
                  <input class="form-control" id="URL" placeholder="Enter URL" type="text" ng-model="invoice.paymentlink">
                </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary" ng-click="addpaymentMethod(invoice.paymentmethod,invoice.paymentlink)">Add</button>
      </div>
    </div>
  </div>
</div>
