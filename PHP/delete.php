<?php
   require 'init.php';
   include("config.php");
         $error = '';
   if(!isset($_SESSION['username']))header('location: index.php');
   
   if( empty( $_POST['datefield'] ) || empty( $_POST['hour'] ) || empty( $_POST['projector'] ) ){
   
               $error = 'All fields are required.';
   
           }
   	else {
   
   
   error_reporting(-1);
   ini_set('display_errors', 'On');
   $servername = "localhost";
   $username = "root";
   $password = "******";
   $dbname = "projector";
   
   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
   }
   
   
   	$date = $_POST['datefield'];
   	$hour = $_POST['hour'];
   	$code = $_SESSION['username'];
   	$projector = $_POST['projector'];
   	$dept = $_SESSION['dept'];
   
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
   		 $error = 'No such projector booked';
   		$res = array('msg'=>'0');
   		$msg = json_encode($res);
   		echo $msg;
   	
   	}
   	else
   	{
   		//success popup
   		$res = array('msg'=>'1');
   		$msg = json_encode($res);
   		echo $msg;
   	}
   }
   ?>