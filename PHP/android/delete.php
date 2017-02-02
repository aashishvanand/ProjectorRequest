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

if (isset($_POST['date']) && isset($_POST['hour']) && isset($_POST['code']) && isset($_POST['projector']) && isset($_POST['dept']) ){

	$date = $_POST['date'];
	$hour = $_POST['hour'];
	$code = $_POST['code'];
	$projector = $_POST['projector'];
	$dept = $_POST['dept'];

	switch ($dept) {
    		case "cse":
		$sql = "DELETE FROM `cse.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
        	break;
    	case "mech":
		$sql = "DELETE FROM `mech.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
        	break;
    	case "cake":
        	echo "i is cake";
        	break;
	}

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
