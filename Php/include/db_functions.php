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

    public function storeData($date, $hour, $staffcode,$projector) {	
        $store = $this->conn->prepare("INSERT INTO request(date, hour, staffcode, requesttime, projector) VALUES(?, ?, ?, NOW(), ?)");
        $store->bind_param("ssss", $date, $hour, $staffcode,$projector);
        $result = $store->execute();
        $store->close();
     }
    

    public function isBooked($date,$hour,$projector) {
        $stmt = $this->conn->prepare("SELECT staffcode from request WHERE date = ? and hour = ? and projector = ?");
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
  
}

?>
