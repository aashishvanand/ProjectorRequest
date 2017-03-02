<?php
   error_reporting(-1);
   ini_set('display_errors', 'On');
   // json response array
   $response = array("error" => FALSE);
   $servername = "localhost";
   $username = "root";
   $password = "*********";
   $dbname = "rec";
   
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
       		case "aero":
			$sql = "DELETE FROM `aero.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
       		case "auto":
			$sql = "DELETE FROM `auto.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "btech":
			$sql = "DELETE FROM `btech.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "bmed":
			$sql = "DELETE FROM `bmed.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "chem":
			$sql = "DELETE FROM `chem.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "civil":
			$sql = "DELETE FROM `civil.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;			
    	   	case "cse":
			$sql = "DELETE FROM `cse.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "eee":
			$sql = "DELETE FROM `eee.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "ece":
			$sql = "DELETE FROM `ece.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "it":
			$sql = "DELETE FROM `it.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "mech":
			$sql = "DELETE FROM `mech.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "mtrcs":
			$sql = "DELETE FROM `mtrcs.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "hd":
			$sql = "DELETE FROM `hd.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "mba":
			$sql = "DELETE FROM `mba.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
			break;
		case "mca":
			$sql = "DELETE FROM `mca.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
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
