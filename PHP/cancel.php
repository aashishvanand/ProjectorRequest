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
      <title>Projector Request - REC</title>
      <style>
         select {
         padding: 16px 20px;
         border: none;
         border-radius: 4px;
         background-color: #f1f1f1;
         }
         tr.spaceUnder > td
         {
         padding-bottom: 1em;
         }
         .button {
         background-color: #4CAF50; /* Green */
         border: none;
         color: white;
         border-radius: 4px;
         padding: 16px 32px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 16px;
         margin: 4px 2px;
         -webkit-transition-duration: 0.4s; /* Safari */
         transition-duration: 0.4s;
         cursor: pointer;
         }
         .cancel {
         background-color: white; 
         color: black; 
         border: 2px solid #f44336;
         }
         .cancel:hover {
         background-color: #f44336;
         color: white;
         }
      </style>
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
                  <a href="home.php">Dashboard</a>
               </li>
               <li>
                  <a href="book.php">Book a Projector</a>
               </li>
               <li>
                  <a href="#">Cancel a Projector</a>
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
                     <h1> Cancel Booking! </h1>
                     <div id="msg"></div>
                     <br>
                     <form method="post" action="delete.php">
                     <table>
                        <tr class="spaceUnder">
                           <td>
                              Select a Date : 
                           </td>
                           <td>
                              <input id="datefield" name="datefield" type='date' min='2017-01-01' max='2100-13-13'></input><br><br>
                           </td>
                        </tr>
                        <tr class="spaceUnder">
                           <td>
                              Select the Hour :
                           </td>
                           <td>
                              <select id="hour" name="hour" name="hour">
                                 <option value="" disabled selected>Select Hour</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 <option value="6">6</option>
                                 <option value="7">7</option>
                                 <option value="8">8</option>
                              </select>
                           </td>
                        </tr>
                        <tr class="spaceUnder">
                           <td>
                              Select Projector :
                           </td>
                           <td>
                              <select name="projector" id="projector" name="projector">
                                 <option value="" disabled selected>Select Projector</option>
                                 <?php 
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "*******";
                                    $dbname = "projector";
                                    
                                    // Create connection
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                                    // Check connection
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $dept = $_SESSION['dept'];
                                    $sql = mysqli_query($conn, "SELECT * FROM `projector` WHERE `department` = '$dept'");
                                    while ($row = $sql->fetch_assoc()){
                                    $projector_name=$row['projectorname'];
                                    echo '<option value="'.$projector_name.'">'.$projector_name.'</option>';
                                    mysqli_close($conn);
                                    }
                                    ?>
                              </select>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <button class="button cancel" name="delete" id="sub-submit" type="submit">Submit</button>
                           </td>
                        </tr>
                     </table>
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
      <script src="js/del.js"></script>
      <!-- Menu Toggle Script -->
      <script>
         $("#menu-toggle").click(function(e) {
             e.preventDefault();
             $("#wrapper").toggleClass("toggled");
         });
      </script>
      <script>
         var today = new Date();
         var dd = today.getDate();
         var mm = today.getMonth()+1; //January is 0!
         var yyyy = today.getFullYear();
          if(dd<10){
                 dd='0'+dd
             } 
             if(mm<10){
                 mm='0'+mm
             } 
         
         today = yyyy+'-'+mm+'-'+dd;
         document.getElementById("datefield").setAttribute("min", today);
      </script>
   </body>
</html>