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
		case "pe":
   		$sql = "DELETE FROM `pe.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "edc":
   		$sql = "DELETE FROM `edc.projector` WHERE date = '$date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
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