<?php
require 'init.php';
include("config.php");
      $error = '';
if(isset($_SESSION['username']))header('location: home.php');

if(isset($_POST["login"])){
     if( empty( $_POST['staffcode'] ) || empty( $_POST['password'] ) ){

            $error = 'Both fields are required.';

        }
	else {
            $sql='select `staffcode` from login where `staffcode`=? and `password`=? limit 1';
            $stmt=$mysqli->prepare( $sql );
            if( !$stmt )exit('Failed to prepare sql statement');
            
            $staffcode=$_POST['staffcode'];
            $password=$_POST['password'];
            $stmt->bind_param('ss', $staffcode, $password );
            $res=$stmt->execute();


            /* bind the result of the query to a variable */
            $stmt->bind_result( $login_user );
            while( $stmt->fetch() ){
                /* go through recordset ( 1 record ) */
                $_SESSION['username'] = $login_user;
		//print_r($login_user);
            }

            $stmt->close();

            if( isset( $_SESSION['username'] ) )header( 'location: home.php' );
            else $error='Incorrect username or password.';
        }//end of else
    }//end of if($_POST['login'])
?>
