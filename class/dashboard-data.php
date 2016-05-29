<?php

  $task = "SELECT * FROM wp_easetasks";
  $appuser = "SELECT * FROM wp_easeappuser";
  $invoice = "SELECT * FROM wp_easeinvoice";
  $employee = "SELECT * FROM wp_easewebuser";

  $taskr = getmyData($task)->fetch_assoc();
  $appuserr =getmyData($appuser)->fetch_assoc();
  $invoicer= getmyData($invoice)->fetch_assoc();
  $employeer= getmyData($employee)->fetch_assoc();

  $taskn =getmyData($task)->num_rows;
  $appusern =getmyData($appuser)->num_rows;
  $invoicen =getmyData($invoice)->num_rows;
  $employeen =getmyData($employee)->num_rows;

  $jsondata = array('numberofitems' => array('task'=>$taskn,'appuser'=>$appusern,'invoice'=>$invoicen,'employee'=>$employeen));
  echo json_encode($jsondata);

function getmyData ($sql){

  $servername = "www.db4free.net";
  $username = "easetech";
  $password = "summer08";
  $dbname = "easetech";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }



  $result = $conn->query($sql);


  $conn->close();
  return $result;
}

?>
