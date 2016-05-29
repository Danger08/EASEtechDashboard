<section class="content" ng-init="getInvoicelist()">
      <div class="row">
        <div class="col-md-3">
          <div>


            <button class="btn btn-primary btn-block margin-bottom" ng-click="ceateInvoice()">Create Invoice</button>

          </div>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Filters {{categoryfilter}}</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="" ng-click="setCategoryFilter(undefined)"><i class="fa fa-inbox"></i> All</a></li>
                <li><a href="" ng-click="setCategoryFilter(0)"><i class="fa fa-pencil"></i> Open </a></li>
                <li><a href="" ng-click="setCategoryFilter(1)"><i class="fa fa-list-alt"></i> Closed <span class="label label-warning pull-right">65</span></a></li>
                <li><a href="" ng-click="setCategoryFilter(2)"><i class="fa fa-trash-o"></i> Pending </a></li>
                <li><a href="" ng-click="setCategoryFilter(3)"><i class="fa fa-trash-o"></i> Paid </a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Invoice list</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input class="form-control input-sm" placeholder="Search Mail" type="text">
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
                  1-50/200
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
                  <tr ng-repeat="singleinvoice in invoicelist | filter:categoryfilter:true">

                    <td><div aria-disabled="false" aria-checked="false" style="position: relative;" class="icheckbox_flat-blue"><input style="position: absolute; opacity: 0;" type="checkbox"><ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" class="iCheck-helper"></ins></div></td>
                    <td class="mailbox-star"><a ng-click="editInvoice(singleinvoice)">ETS-{{fixInvoiceNumber(singleinvoice.invoice_id)}}</a></td>
                    <td class="mailbox-name">{{getInvoiceUserName(singleinvoice.userdata)}} </td>
                    <td class="mailbox-subject"> {{singleinvoice.date | date : 'MMMM/dd/yyyy'}}</td>
                    <td class="mailbox-date">{{singleinvoice.due | date : 'MMMM/dd/yyyy'}}</td>
                    <td class="mailbox-date" style="padding:1px;"><div class="btn-group">
                      <button type="button" class="btn btn-default btn-flat" ng-click="previewInvoiceFromList(singleinvoice.date,singleinvoice.due,singleinvoice.userdata,singleinvoice.invoice_item,singleinvoice.payment_methodlist,'preview',singleinvoice.invoice_id)"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-default btn-flat" ng-click="previewInvoiceFromList(singleinvoice.date,singleinvoice.due,singleinvoice.userdata,singleinvoice.invoice_item,singleinvoice.payment_methodlist,'pdf',singleinvoice.invoice_id)"><i class="fa fa-file-pdf-o"></i></button>
                      <button type="button" class="btn btn-default btn-flat" ng-click="previewInvoiceFromList(singleinvoice.date,singleinvoice.due,singleinvoice.userdata,singleinvoice.invoice_item,singleinvoice.payment_methodlist,'print',singleinvoice.invoice_id)"><i class="fa fa-print"></i></button>
                      <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target=".deletemodal" ng-click="setInvoiceIDforDelete(singleinvoice.invoice_id)"><i class="fa fa-trash"></i></button>
                    </div></td>
                  </tr>

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
                  1-50/200
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


      <div class="modal fade bs-example-modal-sm deletemodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> <h4 class="modal-title" id="mySmallModalLabel">Delete Invoice</h4> </div>
            <div class="modal-body"> You are about to Delete <strong> ETS - {{fixInvoiceNumber(invoiceIDforDelete)}} </strong> Invoice</div>
            <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-danger" ng-click="deleteInvoice(invoiceIDforDelete)" data-dismiss="modal">Delete</button> </div>
          </div>
        </div>
      </div>
