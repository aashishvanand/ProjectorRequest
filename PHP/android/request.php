<?php
   error_reporting(-1);
   ini_set('display_errors', 'On');
   require_once 'include/db_functions.php';
   $db = new db_functions();
   
   if (isset($_POST['date']) && isset($_POST['hour']) && isset($_POST['staffcode']) && isset($_POST['projector']) && isset($_POST['department']) && isset($_POST['year']) && isset($_POST['section'])&& isset($_POST['dept'])) {
   
   	$date=$_POST['date'];
   	$hour=$_POST['hour'];
   	$staffcode=$_POST['staffcode'];
   	$projector=$_POST['projector'];
   	$department=$_POST['department'];
   	$year=$_POST['year'];
   	$section=$_POST['section'];
   	$dept=$_POST['dept'];
   
   	 if ($db->isBooked($date,$hour,$projector,$dept)) {
           $response["error"] = TRUE;
           $response["error_msg"] = "Already Booked";
       	}	
   	else {
   	$response["error"] = FALSE;
   	$data = $db->storeData($date, $hour, $staffcode,$projector,$department,$year,$section,$dept);
   	
   	}
   }
   
   else
   {
   $response["error"] = TRUE;
   }
   
   echo json_encode($response);
   
   ?>