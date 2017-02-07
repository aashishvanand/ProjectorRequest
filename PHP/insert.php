<?php
   require 'init.php';
   include("config.php");
         $error = '';
   if(!isset($_SESSION['username']))header('location: index.php');
   
   
        if( empty( $_POST['date'] ) || empty( $_POST['hour'] ) || empty( $_POST['projector'] ) || empty( $_POST['year']) || empty( $_POST['department']) || empty( $_POST['section'] )){
   
               $error = 'All fields are required.';
   	    echo $error;
           }
   	else {
   $staffcode = $_SESSION['username'];
   $date=$_POST['date'];
   $hour=$_POST['hour'];
   $projector=$_POST['projector'];
   $year=$_POST['year'];
   $dept=$_POST['department'];
   $section=$_POST['section'];	
   
   /*
   define("DB_HOST", "localhost");
   define("DB_USER", "root");
   define("DB_PASSWORD", "R0TeSD0aL@!");
   define("DB_DATABASE", "projector");
   $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
   */
   switch ($dept) {
       		case "cse":
   			$stmt = $mysqli->prepare("SELECT staffcode from `cse.projector` WHERE date = ? and hour = ? and projector = ?");
           		break;
       		case "mech":
   			$stmt = $mysqli->prepare("SELECT staffcode from `mech.projector` WHERE date = ? and hour = ? and projector = ?");
           		break;
       	}
   	$stmt->execute();
           $stmt->bind_param("sss", $date,$hour,$projector);
           $stmt->execute();
           $stmt->store_result();
   
           if ($stmt->num_rows > 0) {
               $stmt->close();
   	    $resp = array('msg'=>'0');
   	    echo json_encode($resp);
           } else {
               $stmt->close();
               
   switch ($dept) {
       		case "cse":
   			$store = $mysqli->prepare("INSERT INTO `cse.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
           		break;
       		case "mech":
   			$store = $mysqli->prepare("INSERT INTO `mech.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
          			break;
       	}
   	$staff='test';
           $store->bind_param("sssssss", $date, $hour, $staffcode,$projector,$dept,$year,$section);
           $store->execute();
   	$resp = array('msg'=>'1');
           echo json_encode($resp);
   	//success inserted popup
   
           }//ENDO OF nUM_ROWS
              
   		
            }//end of else
   ?>