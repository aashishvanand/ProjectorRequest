<?php
   error_reporting(-1);
   ini_set('display_errors', 'On'); 
   class db_functions {
   
       private $conn;
   
       // constructor
       function __construct() {
           require_once 'db_connect.php';
           // connecting to database
           $db = new db_connect();
           $this->conn = $db->connect();
       }
   
       // destructor
       function __destruct() {
   
      }
   
       public function storeData($date, $hour, $staffcode,$projector,$department,$year,$section,$dept) {
   	
   	switch ($dept) {
       		case "aero":
				$store = $this->conn->prepare("INSERT INTO `aero.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "auto":
				$store = $this->conn->prepare("INSERT INTO `auto.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "btech":
				$store = $this->conn->prepare("INSERT INTO `btech.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "bmed":
				$store = $this->conn->prepare("INSERT INTO `bmed.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "chem":
				$store = $this->conn->prepare("INSERT INTO `chem.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "civil":
				$store = $this->conn->prepare("INSERT INTO `civil.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;			
			case "cse":
				$store = $this->conn->prepare("INSERT INTO `cse.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "eee":
				$store = $this->conn->prepare("INSERT INTO `eee.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "ece":
				$store = $this->conn->prepare("INSERT INTO `ece.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "it":
				$store = $this->conn->prepare("INSERT INTO `it.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mech":
				$store = $this->conn->prepare("INSERT INTO `mech.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mtrcs":
				$store = $this->conn->prepare("INSERT INTO `mtrcs.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "hd":
				$store = $this->conn->prepare("INSERT INTO `hd.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "pe":
				$store = $this->conn->prepare("INSERT INTO `pe.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "edc":
				$store = $this->conn->prepare("INSERT INTO `edc.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mba":
				$store = $this->conn->prepare("INSERT INTO `mba.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
			case "mca":
				$store = $this->conn->prepare("INSERT INTO `mca.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
				break;
       	}
   
           $store->bind_param("sssssss", $date, $hour, $staffcode,$projector,$department,$year,$section);
           $result = $store->execute();
           $store->close();
        }
       
   
       public function isBooked($date,$hour,$projector,$dept) {
   	switch ($dept) {
       		case "aero":
				$stmt = $this->conn->prepare("SELECT staffcode from `aero.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "auto":
				$stmt = $this->conn->prepare("SELECT staffcode from `auto.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "btech":
				$stmt = $this->conn->prepare("SELECT staffcode from `btech.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "bmed":
				$stmt = $this->conn->prepare("SELECT staffcode from `bmed.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "chem":
				$stmt = $this->conn->prepare("SELECT staffcode from `chem.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "civil":
				$stmt = $this->conn->prepare("SELECT staffcode from `civil.projector` WHERE date = ? and hour = ? and projector = ?");
				break;			
			case "cse":
				$stmt = $this->conn->prepare("SELECT staffcode from `cse.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "eee":
				$stmt = $this->conn->prepare("SELECT staffcode from `eee.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "ece":
				$stmt = $this->conn->prepare("SELECT staffcode from `ece.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "it":
				$stmt = $this->conn->prepare("SELECT staffcode from `it.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mech":
				$stmt = $this->conn->prepare("SELECT staffcode from `mech.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mtrcs":
				$stmt = $this->conn->prepare("SELECT staffcode from `mtrcs.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "hd":
				$stmt = $this->conn->prepare("SELECT staffcode from `hd.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "pe":
				$stmt = $this->conn->prepare("SELECT staffcode from `pe.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "edc":
				$stmt = $this->conn->prepare("SELECT staffcode from `edc.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mba":
				$stmt = $this->conn->prepare("SELECT staffcode from `mba.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
			case "mca":
				$stmt = $this->conn->prepare("SELECT staffcode from `mca.projector` WHERE date = ? and hour = ? and projector = ?");
				break;
       	}
   	$stmt->execute();
           $stmt->bind_param("sss", $date,$hour,$projector);
           $stmt->execute();
           $stmt->store_result();
   
           if ($stmt->num_rows > 0) {
               $stmt->close();
               return true;
           } else {
               $stmt->close();
               return false;
           }
       }
   
       public function getsraffByStaffcodeAndPassword($staffcode, $password) {
   
           $stmt = $this->conn->prepare("SELECT * FROM login WHERE staffcode = ?");
   
           $stmt->bind_param("s", $staffcode);
   
           if ($stmt->execute()) {
               $user = $stmt->get_result()->fetch_assoc();
               $stmt->close();
   
               if ($password == $user['password']) {
                   // user authentication details are correct
                   return $user;
               }
           } else {
               return NULL;
           }
       }
     
   }
   
   ?>