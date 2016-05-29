<?PHP 

session_name('LoginForm');
@session_start();

error_reporting(0);
include("config.php");

echo json_encode($_SESSION['user_info']);


?>