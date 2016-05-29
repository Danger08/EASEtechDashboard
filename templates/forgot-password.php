<?php
error_reporting(E_ALL);

ini_set('display_errors', '1');
$servername = "www.db4free.net";
$username = "easetech";
$password = "summer08";
$dbname = "easetech";
$appusername = $_GET['username'];
$code = generateRandomString();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `wp_easeappuser` SET `activation_code` = '". $code ."' WHERE `username` = '" . $appusername ."'";

if ($conn->query($sql) === TRUE) {
   echo json_encode(array('status' => 1 ));
} else {
   echo json_encode(array('status' => 0 ));
}

$conn->close();

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
