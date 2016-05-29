<?PHP

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

session_start();
$id = $_GET['id'];
$status = $_GET['status'];
$servername = "www.db4free.net";
$username = "easetech";
$password = "summer08";
$dbname = "easetech";


if(isset($id) and isset($status)){
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $now = strtotime("now");
  if(isset($status)){
    $sql = "UPDATE wp_easeappuser SET status=$status , last_update = $now WHERE ease_userid=$id";
  }else {
    $sql = "UPDATE wp_easeappuser SET last_update = $now WHERE ease_userid=$id";
  }


  if ($conn->query($sql) === TRUE) {
    //  echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }

  $conn->close();

}
getData();
function getData (){
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

$sql = "SELECT ease_userid, status ,last_update FROM wp_easeappuser";
$result = $conn->query($sql);
$rows = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $gap = strtotime("+10 seconds") - $row['last_update'];
      $row['gap'] = $gap;
      $row['status'] = intval($row['status']);
        if($row['status']==1 or $row['status']==0){
          if($gap > 20){
            $row['status'] = 0;
          }else {
            $row['status'] = 1;
          }
        }else{
        }


        $rows[$row['ease_userid']] = $row;
          //echo print_r($row);

    }
} else {
    echo "0 results";
}


echo json_encode($rows);
$conn->close();
}
?>
