

<?php


if (isset($_GET['input']) and $_GET['input']==true){
?>
<html>
<head >
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EASE Technology Solutions | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/dist/css/AdminLTE.min.css">
  <script src="js/angular/angular.min.js"></script>
  <script src="lib/jspdf/libs/FileSaver.js/FileSaver.min.js" charset="utf-8"></script>
  <script src="lib/jspdf/libs/html2canvas/dist/html2canvas.js"></script>
  <script src="lib/jspdf/dist/jspdf.debug.js"></script>
  <?PHP
    $username = $_GET['username'];
  $invoicedata = fopen('templates/transactions/invoicedata/' . $username . '.json' , 'r');
  ?>

  <script >
  var app = angular.module('invoiceModule',[]);
  app.controller('invoiceCtrl',function($scope){
    console.log('controller loaded');

    $scope.invoicedata = angular.fromJson(<?PHP echo fread($invoicedata,filesize("templates/transactions/invoicedata/" . $username . ".json")); ?>);
    $scope.invoiceitemtotal = 0;
    for(i=0;i < $scope.invoicedata.invoiceitem.length; i++){
    $scope.invoiceitemtotal +=  parseInt($scope.invoicedata.invoiceitem[i].price);
    }
    console.log($scope.invoicedata);
    $scope.invoiceid = <?PHP
    if(isset($_GET['invoiceid'])){
      echo $_GET["invoiceid"]; echo ";";
    }
    ?>
    $scope.fixInvoiceNumber = function (a){
    var b ="";
      switch (a.toString().length) {
        case 1:
          b = "00000" + a.toString();
        break;
        case 2:
          b = "0000" + a.toString();
        break;
        case 3:
          b = "000" + a.toString();
        break;
        case 4:
          b = "00" + a.toString();
        break;
        case 5:
          b = "0" + a.toString();
        break;
        case 6:
          b = a.toString();
        break;

      }
      return b;
    };
  });

  </script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body ng-app="invoiceModule" ng-controller="invoiceCtrl">

  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> EASE Technology Solutions
            <small class="pull-right">Date: {{invoicedata.date | date : 'MM/dd/yyyy'}}</small>
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
            <strong>{{invoicedata.userdata.firstname}} {{invoicedata.userdata.lastname}}</strong><br>
            <p style="height:80px;width:200px">
              {{invoicedata.userdata.address}}<br>
              {{invoicedata.userdata.mobile}}<br>
              {{invoicedata.userdata.email}}
            </p>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice </b>ETS - <span ng-show="invoiceid!=undefined">{{fixInvoiceNumber(invoiceid)}}</span> <br>
          <b>Payment Due:</b> {{invoicedata.due | date : 'MM/dd/yyyy'}}<br>
          <b>Client ID:</b> {{invoicedata.userdata.ease_userid}}
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
              </tr>
            </thead>
            <tbody>

              <tr ng-repeat="item in invoicedata.invoiceitem">
                <td>{{item.name}}</td>
                <td>{{item.description}}</td>
                <td>{{item.price}}</td>
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
          <p class="lead">Payment Methods: </p>
          <span ng-repeat="paymentmethod in invoicedata.paymentmethodlist" style="max-width:64px;">
            <a target="_blank"  >
              <img src="img/paymentimg/{{paymentmethod.gateway}}.png" alt="{{paymentmethod.gateway}}" height="40px" width="auto">
            </a>
          </span>

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due {{invoicedata.due | date : 'MM/dd/yyyy'}}</p>

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
        <!-- <div class="row no-print">
          <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Create Invoice
            </button>
            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
              <i class="fa fa-download"></i> Generate PDF
            </button>
          </div>
        </div> -->
      </section>
    </section>
  </div><!-- ./wrapper -->

  <!-- AdminLTE App -->
  <script type="text/javascript">
window.onload = function () {
  var pdf = new jsPDF('p','pt','a4');
  pdf.addHTML(document.getElementsByClassName('invoice'),function() {
  pdf.save('web.pdf');
  });
 }


  </script>
</body>
</html>
<?PHP
}
else {

 $invoicedata = file_get_contents("php://input");
 $objInvoiceData = json_decode($invoicedata);
 $username = $objInvoiceData->userdata->username;
$invoicedata = fopen('invoicedata/' . $username . '.json' , 'w');
fwrite($invoicedata,json_encode($objInvoiceData));
}
?>
