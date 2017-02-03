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
    		case "cse":
			$store = $this->conn->prepare("INSERT INTO `cse.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
        		break;
    		case "mech":
			$store = $this->conn->prepare("INSERT INTO `mech.projector`(date, hour, staffcode, requesttime, projector,department,year,section) VALUES(?, ?, ?, NOW(), ?,?,?,?)");
       			break;
    	}

        $store->bind_param("sssssss", $date, $hour, $staffcode,$projector,$department,$year,$section);
        $result = $store->execute();
        $store->close();
     }
    

    public function isBooked($date,$hour,$projector,$dept) {
	switch ($dept) {
    		case "cse":
			$stmt = $this->conn->prepare("SELECT staffcode from `cse.projector` WHERE date = ? and hour = ? and projector = ?");
        		break;
    		case "mech":
			$stmt = $this->conn->prepare("SELECT staffcode from `mech.projector` WHERE date = ? and hour = ? and projector = ?");
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
