<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// json response array
$response = array("error" => FALSE);
$servername = "localhost";
$username = "root";
$password = "*******";
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
$today = date('Y-m-d');
$sql = "SELECT * FROM request WHERE date = '$today'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc())
	{
	array_push($hour,$row["hour"]);
	array_push($staffcode,$row["staffcode"]);
	array_push($model,$row["projector"]);
	}

$response["hour"] = $hour;
$response["staffcode"] = $staffcode;
$response["projector"] = $model;
}
else
{
$response["error"] = TRUE;
}

echo json_encode($response);
?>
