<?php
    /* home.php */
    require 'init.php';
    require 'config.php';
    if(!isset( $_SESSION['username']))header('location: index.php');
	 
?>
 <!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>
        <h1 class="hello">Hello, <em><?php echo $_SESSION['username'];?>!</em></h1>
        <br><br><br>
        <a href="logout.php" style="font-size:18px">Logout?</a>
    </body>
</html>
