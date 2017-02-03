<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once 'include/db_functions.php';
$db = new db_functions();

// json response array
$response = array("error" => FALSE);
$servername = "localhost";
$username = "root";
$password = "R0TeSD0aL@!";
$dbname = "smartenc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['staffcode']) && isset($_POST['password'])) {

    // receiving the post params
    $staffcode = $_POST['staffcode'];
    $password = $_POST['password'];
	
    $user = $db->getsraffByStaffcodeAndPassword($staffcode, $password);
    if ($user != false) {

	$response["department"] = $user['department'];
        echo json_encode($response);
    }
    else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
}
else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}

?>