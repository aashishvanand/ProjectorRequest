<?php
   /* home.php */
   require 'init.php';
   require 'config.php';
   if(!isset( $_SESSION['username']))header('location: index.php');
   
   ?>       
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <style>
         table {
         border-collapse: collapse;
         width: 100%;
         }
         th, td {
         text-align: left;
         padding: 8px;
         }
         tr:nth-child(even){background-color: #f2f2f2}
      </style>
      <title>Projector Request - REC</title>
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="css/simple-sidebar.css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <div id="wrapper">
         <!-- Sidebar -->
         <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
               <li class="sidebar-brand">
                  <a href="#">
                  Projector Request
                  </a>
               </li>
               <li>
                  <a href="#">Dashboard</a>
               </li>
               <li>
                  <a href="book.php">Book a Projector</a>
               </li>
               <li>
                  <a href="cancel.php">Cancel a Projector</a>
               </li>
               <li>
                  <a href="logout.php">Logout</a>
               </li>
            </ul>
         </div>
         <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Hide Menu</a>
                     <h1 class="hello">Welcome, <em><?php echo $_SESSION['username']; ?>!</em></h1>
                     <br><br>
                     <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "********";
                        $dbname = "projector";
                        
                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $today = date('Y-m-d');
                        $thisweek = date('Y-m-d', strtotime('+6 days'));
                        $staffcode = $_SESSION['username'];
                        switch ($_SESSION['dept']) {
                            		case "aero":
										$sql = "SELECT DISTINCT date FROM `aero.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "auto":
										$sql = "SELECT DISTINCT date FROM `auto.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "btech":
										$sql = "SELECT DISTINCT date FROM `btech.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "bmed":
										$sql = "SELECT DISTINCT date FROM `bmed.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "chem":
										$sql = "SELECT DISTINCT date FROM `chem.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "civil":
										$sql = "SELECT DISTINCT date FROM `civil.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;			
									case "cse":
										$sql = "SELECT DISTINCT date FROM `cse.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "eee":
										$sql = "SELECT DISTINCT date FROM `eee.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "ece":
										$sql = "SELECT DISTINCT date FROM `ece.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "it":
										$sql = "SELECT DISTINCT date FROM `it.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "mech":
										$sql = "SELECT DISTINCT date FROM `mech.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "mtrcs":
										$sql = "SELECT DISTINCT date FROM `mtrcs.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "hd":
										$sql = "SELECT DISTINCT date FROM `hd.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "pe":
										$sql = "SELECT DISTINCT date FROM `pe.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "edc":
										$sql = "SELECT DISTINCT date FROM `edc.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "mba":
										$sql = "SELECT DISTINCT date FROM `mba.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
									case "mca":
										$sql = "SELECT DISTINCT date FROM `mca.projector` WHERE (date BETWEEN '$today' AND '$thisweek') AND staffcode = '$staffcode' order by date asc";
										break;
                            	}
                        
                        $result = mysqli_query($conn, $sql);
                        echo '<h4>My Requests</h4>';
                        
                        if (mysqli_num_rows($result) > 0) { 
                        echo '<div style="overflow-x:auto;">';
                        echo "<table align='center'><tr><th>Date</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th></tr>";
                        //if there exists some DATES
                            while($row = mysqli_fetch_assoc($result)) {
                        	$hours = array_fill(0,8,'AVAIL');
                        	$staff = array_fill(0,8,'NULL');
                        	$date= $row['date'];
                        
                        switch ($_SESSION['dept']) {
                            		case "aero":
										$sql_date_fetch = "SELECT * FROM `aero.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "auto":
										$sql_date_fetch = "SELECT * FROM `auto.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "btech":
										$sql_date_fetch = "SELECT * FROM `btech.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "bmed":
										$sql_date_fetch = "SELECT * FROM `bmed.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "chem":
										$sql_date_fetch = "SELECT * FROM `chem.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "civil":
										$sql_date_fetch = "SELECT * FROM `civil.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;			
									case "cse":
										$sql_date_fetch = "SELECT * FROM `cse.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "eee":
										$sql_date_fetch = "SELECT * FROM `eee.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "ece":
										$sql_date_fetch = "SELECT * FROM `ece.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "it":
										$sql_date_fetch = "SELECT * FROM `it.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "mech":
										$sql_date_fetch = "SELECT * FROM `mech.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "mtrcs":
										$sql_date_fetch = "SELECT * FROM `mtrcs.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "hd":
										$sql_date_fetch = "SELECT * FROM `hd.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "pe":
										$sql_date_fetch = "SELECT * FROM `pe.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "edc":
										$sql_date_fetch = "SELECT * FROM `edc.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "mba":
										$sql_date_fetch = "SELECT * FROM `mba.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
									case "mca":
										$sql_date_fetch = "SELECT * FROM `mca.projector` WHERE date='$date' AND staffcode = '$staffcode'";
										break;
                            	}
                        
                        	$result_date = mysqli_query($conn, $sql_date_fetch);
                        
                        	while($row_date = mysqli_fetch_assoc($result_date)) {
                        		if(strcmp($hours[$row_date['hour']-1], 'AVAIL')==0)$hours[$row_date['hour']-1]=$row_date['projector'].' For '.$row_date['year'].' '.$row_date['department'].' '.$row_date['section']."<br><br>";
                        		else $hours[$row_date['hour']-1] .=$row_date['projector'].' For '.$row_date['year'].' '.$row_date['department'].' '.$row_date['section']."<br><br>";}
                        	$new_table_row = '<tr><th>'.$row['date'].'</th>';
                        	foreach($hours as $hour){
                        		$new_table_row .= '<th>'.$hour.'</th>';
                        	}
                        	$new_table_row .='</tr>';
                        	echo $new_table_row;
                         }
                        }
                         else {
                            echo "No Bookings Yet!";
                        }
                        echo '</table>';
                        echo '<div>';
                        
                        mysqli_close($conn);
                        ?>      
                     <br>
                     <br>
                     <br>
                     <br>
                     <br>
                  </div>
               </div>
            </div>
         </div>
         <!-- /#page-content-wrapper -->
      </div>
      <!-- /#wrapper -->
      <!-- jQuery -->
      <script src="js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
      <!-- Menu Toggle Script -->
      <script>
         $("#menu-toggle").click(function(e) {
             e.preventDefault();
             $("#wrapper").toggleClass("toggled");
         });
      </script>
   </body>
</html>
