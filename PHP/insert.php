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
   
   switch ($dept) {
       		case "aero":
			$stmt = $mysqli->prepare("SELECT staffcode from `aero.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "auto":
				$stmt = $mysqli->prepare("SELECT staffcode from `auto.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "btech":
				$stmt = $mysqli->prepare("SELECT staffcode from `btech.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "bmed":
				$stmt = $mysqli->prepare("SELECT staffcode from `bmed.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "chem":
				$stmt = $mysqli->prepare("SELECT staffcode from `chem.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "civil":
				$stmt = $mysqli->prepare("SELECT staffcode from `civil.projector` WHERE date = ? and hour = ? and projector = ?");
				break;			
			case "cse":
				$stmt = $mysqli->prepare("SELECT staffcode from `cse.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "eee":
				$stmt = $mysqli->prepare("SELECT staffcode from `eee.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "ece":
				$stmt = $mysqli->prepare("SELECT staffcode from `ece.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "it":
				$stmt = $mysqli->prepare("SELECT staffcode from `it.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mech":
				$stmt = $mysqli->prepare("SELECT staffcode from `mech.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mtrcs":
				$stmt = $mysqli->prepare("SELECT staffcode from `mtrcs.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "hd":
				$stmt = $mysqli->prepare("SELECT staffcode from `hd.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "pe":
				$stmt = $mysqli->prepare("SELECT staffcode from `pe.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "edc":
				$stmt = $mysqli->prepare("SELECT staffcode from `edc.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mba":
				$stmt = $mysqli->prepare("SELECT staffcode from `mba.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mca":
				$stmt = $mysqli->prepare("SELECT staffcode from `mca.projector` WHERE date = ? and hour = ? and projector = ?");
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
       		case "aero":
				$store = $mysqli->prepare("INSERT INTO `aero.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "auto":
				$store = $mysqli->prepare("INSERT INTO `auto.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "btech":
				$store = $mysqli->prepare("INSERT INTO `btech.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "bmed":
				$store = $mysqli->prepare("INSERT INTO `bmed.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "chem":
				$store = $mysqli->prepare("INSERT INTO `chem.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "civil":
				$store = $mysqli->prepare("INSERT INTO `civil.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;			
			case "cse":
				$store = $mysqli->prepare("INSERT INTO `cse.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "eee":
				$store = $mysqli->prepare("INSERT INTO `eee.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "ece":
				$store = $mysqli->prepare("INSERT INTO `ece.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "it":
				$store = $mysqli->prepare("INSERT INTO `it.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mech":
				$store = $mysqli->prepare("INSERT INTO `mech.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mtrcs":
				$store = $mysqli->prepare("INSERT INTO `mtrcs.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "hd":
				$store = $mysqli->prepare("INSERT INTO `hd.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "pe":
				$store = $mysqli->prepare("INSERT INTO `pe.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "edc":
				$store = $mysqli->prepare("INSERT INTO `edc.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mba":
				$store = $mysqli->prepare("INSERT INTO `mba.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mca":
				$store = $mysqli->prepare("INSERT INTO `mca.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
       	}
           $store->bind_param("sssssss", $date, $hour, $staffcode,$projector,$dept,$year,$section);
           $store->execute();
   	$resp = array('msg'=>'1');
           echo json_encode($resp);
           }
              
   		
            }
   ?>