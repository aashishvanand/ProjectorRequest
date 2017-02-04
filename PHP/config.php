<?php
   $DB_HOST = "localhost";
   $DB_USER = "root";
   $DB_PASSWORD = "*******";
   $DB_DATABASE = "projector";
   
      $mysqli = new mysqli($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);
   if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
       }
   ?>