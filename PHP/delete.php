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
		
		$date_arr = explode(" ", $date);
	switch(strtolower($date_arr[1])){
	case 'january': $date_arr[1]='01';break;
	case 'february': $date_arr[1]='02';break;
	case 'march': $date_arr[1]='03';break;
	case 'april': $date_arr[1]='04';break;
	case 'may': $date_arr[1]='05';break;
	case 'june': $date_arr[1]='06';break;
	case 'july': $date_arr[1]='07';break;
	case 'august': $date_arr[1]='08';break;
	case 'september': $date_arr[1]='09';break;
	case 'october': $date_arr[1]='10';break;
	case 'november': $date_arr[1]='11';break;
	case 'december': $date_arr[1]='12';break;
	}
	$final_date=implode('-',$date_arr);
   
   	switch ($dept) {
      	case "aero":
   		$sql = "DELETE FROM `aero.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
       	case "auto":
   		$sql = "DELETE FROM `auto.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "btech":
   		$sql = "DELETE FROM `btech.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "bmed":
   		$sql = "DELETE FROM `bmed.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "chem":
   		$sql = "DELETE FROM `chem.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "civil":
   		$sql = "DELETE FROM `civil.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;			
      	 	case "cse":
   		$sql = "DELETE FROM `cse.projector` WHERE date = '$finaldate' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "eee":
   		$sql = "DELETE FROM `eee.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "ece":
   		$sql = "DELETE FROM `ece.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "it":
   		$sql = "DELETE FROM `it.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "mech":
   		$sql = "DELETE FROM `mech.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "mtrcs":
   		$sql = "DELETE FROM `mtrcs.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "hd":
   		$sql = "DELETE FROM `hd.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "pe":
   		$sql = "DELETE FROM `pe.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "edc":
   		$sql = "DELETE FROM `edc.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "mba":
   		$sql = "DELETE FROM `mba.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
           	break;
		case "mca":
   		$sql = "DELETE FROM `mca.projector` WHERE date = '$final_date' AND hour = '$hour' AND staffcode ='$code' AND projector ='$projector'";
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
