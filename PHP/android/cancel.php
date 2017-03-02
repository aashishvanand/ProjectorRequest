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
    		case "aero":
			$sql = "SELECT * FROM `aero.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
       		case "auto":
			$sql = "SELECT * FROM `auto.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "btech":
			$sql = "SELECT * FROM `btech.projector` WHERE date >= '$today' and staffcode = '$code'";
           		break;
		case "bmed":
			$sql = "SELECT * FROM `bmed.projector` WHERE date >= '$today' and staffcode = '$code'";
        	   	break;
		case "chem":
			$sql = "SELECT * FROM `chem.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "civil":
			$sql = "SELECT * FROM `civil.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;			
    	   	case "cse":
			$sql = "SELECT * FROM `cse.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "eee":
			$sql = "SELECT * FROM `eee.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "ece":
			$sql = "SELECT * FROM `ece.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "it":
			$sql = "SELECT * FROM `it.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "mech":
			$sql = "SELECT * FROM `mech.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "mtrcs":
			$sql = "SELECT * FROM `mtrcs.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "hd":
			$sql = "SELECT * FROM `hd.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "mba":
			$sql = "SELECT * FROM `mba.projector` WHERE date >= '$today' and staffcode = '$code'";
			break;
		case "mca":
			$sql = "SELECT * FROM `mca.projector` WHERE date >= '$today' and staffcode = '$code'";
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
