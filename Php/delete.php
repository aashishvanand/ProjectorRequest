<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// json response array
$response = array("error" => FALSE);
$servername = "localhost";
$username = "root";
$password = "*********";
$dbname = "projector";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$hour=array();
$staffcode=array();
$model=array();

if (isset($_POST['date']) && isset($_POST['hour']) && isset($_POST['code']) ){

	$date = $_POST['date'];
	$hour = $_POST['hour'];
	$code = $_POST['code'];

	$sql = "DELETE FROM request WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code'";
	$result = $conn->query($sql);
	if(mysqli_affected_rows($conn) === 0)
	{
		$response["error"] = TRUE;
		$response["error_msg"] = "No Such Projector Booked";
	
	}
	else
	{
		$response["error"] = FALSE;
	}
}
else{
	$response["error"] = TRUE;
	$response["error_msg"] = "Invalid Parameters";

}

echo json_encode($response);
?>
