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
   $year=array();
   $department=array();
   $section=array();
   
   if (isset($_POST['date']) && isset($_POST['dept'])){
   
   	$today = $_POST['date'];
   	$dept = $_POST['dept'];
   
   	switch ($dept) {
       		case "cse":
   			$sql = "SELECT * FROM `cse.projector` WHERE date = '$today' ORDER BY hour";
           		break;
       		case "mech":
   			$sql = "SELECT * FROM `mech.projector` WHERE date = '$today' ORDER BY hour";
           		break;
       	}
   
   	$result = $conn->query($sql);
   	if ($result && $result->num_rows > 0) {
        		while($row = $result->fetch_assoc())
   		{
   		array_push($hour,$row["hour"]);
   		array_push($staffcode,$row["staffcode"]);
   		array_push($model,$row["projector"]);
   		array_push($year,$row["year"]);
   		array_push($department,$row["department"]);
   		array_push($section,$row["section"]);
   
   		}
   	$response["hour"] = $hour;
   	$response["staffcode"] = $staffcode;
   	$response["projector"] = $model;
   	$response["year"] = $year;
   	$response["department"] = $department;
   	$response["section"] = $section;
   	}
   	else
   	{
   		$response["error"] = TRUE;
   		$response["error_msg"] = "No Projector Booked Still!";
   
   
   	}
   }
   else
   	{
   		$response["error"] = TRUE;
   	}
   
   echo json_encode($response);
   ?>