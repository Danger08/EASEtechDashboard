<?PHP
if(isset($_GET['page']) AND $_GET['page']=='invoicepreview'){
  include_once("templates/transactions/invoice-preview.php");
}
elseif (isset($_GET['page']) AND $_GET['page']=='printinvoice') {
  include_once("templates/transactions/invoice-print.php");
}elseif (isset($_GET['page']) AND $_GET['page']=='pdfinvoice') {
  include_once("templates/transactions/invoice-pdf.php");
}

?>
