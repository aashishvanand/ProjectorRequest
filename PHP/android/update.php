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
   $projector = array();
   if (isset($_POST['dept']) ){
   	$dept = $_POST['dept'];
   	$sql = "SELECT * FROM `projector` WHERE department = '$dept'";
   	$result = $conn->query($sql);
   	if ($result->num_rows > 0) {
   		while($row = $result->fetch_assoc())
   		{
   			$names = $row["projectorname"];
   			array_push($projector,$names);
   		}
   	}
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