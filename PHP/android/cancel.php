<?php
error_reporting(-1);
ini_set('display_errors', 'On');

// json response array
$response = array("error" => FALSE);
$servername = "localhost";
$username = "root";
$password = "********";
$dbname = "rec";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$date = array();
$hour = array();
$projector = array();
$today = date('Y-m-d');

if ( (isset($_POST['code'])) && (isset($_POST['dept'])) ){

	$code = $_POST['code'];
	$dept = $_POST['dept'];
	switch ($dept) {
    		case "cse":
			$sql = "SELECT * FROM `cse.projector` WHERE date >= '$today' and staffcode = '$code'";
        		break;
    		case "mech":
			$sql = "SELECT * FROM `mech.projector` WHERE date >= '$today' and staffcode = '$code'";
        		break;
			}
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc())
		{
			array_push($date,$row["date"]);
			array_push($hour,$row["hour"]);
			array_push($projector,$row["projector"]);

		}
	}

	$response["date"]=$date;
	$response["hour"]=$hour;
	$response["projector"]=$projector;
	echo json_encode($response);
}
else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters is missing!";
    echo json_encode($response);
}

?>
