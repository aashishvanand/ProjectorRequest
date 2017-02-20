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

$date_array = array();
$hour_array = array();
$projector_array = array();
$today = date('d/m/Y');

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
			$date = $row["date"];
			array_push($date_array,$date);

			$hour = $row["hour"];
			array_push($hour_array,$hour);

			$projector = $row["projector"];
			array_push($projector_array,$projector);

		}
	}

	$response["date"]=$date_array;
	$response["hour"]=$hour_array;
	$response["projector"]=$projector_array;
	echo json_encode($response);
}
else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters is missing!";
    echo json_encode($response);
}

?>
