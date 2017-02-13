<html>
   <head>
      <title>Projector Request - Chemical</title>
      <style type="text/css">
         table {
         border-collapse: collapse;
         width: 100%;
         }
         th, td {
         text-align: left;
         padding: 8px;
         }
         h1 {text-align: center;}
         tr:nth-child(even){background-color: #f2f2f2}
      </style>
   </head>
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
      $today = date('Y-m-d');
      $thisweek = date('Y-m-d', strtotime('+6 days'));
      $sql = "SELECT DISTINCT date FROM `chem.projector` WHERE (date BETWEEN '$today' AND '$thisweek') order by date asc";
      $result = mysqli_query($conn, $sql);
      echo '<h1>Projector Request - Chemical</h1>';
      
      if (mysqli_num_rows($result) > 0) { 
      echo '<div style="overflow-x:auto;">';
      echo "<table align='center'><tr><th>Date</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th></tr>";
      //if there exists some DATES
          while($row = mysqli_fetch_assoc($result)) {
      	$hours = array_fill(0,8,'AVAIL');
      	$staff = array_fill(0,8,'NULL');
      	$date= $row['date'];
      	$sql_date_fetch = "SELECT * FROM `chem.projector` WHERE date='$date'";
      	$result_date = mysqli_query($conn, $sql_date_fetch);
      
      	while($row_date = mysqli_fetch_assoc($result_date)) {
      		if(strcmp($hours[$row_date['hour']-1], 'AVAIL')==0)$hours[$row_date['hour']-1]=$row_date['projector'].' Booked By '.$row_date['staffcode'].' For '.$row_date['year'].' '.$row_date['department'].' '.$row_date['section']."<br><br>";
      		else $hours[$row_date['hour']-1] .=$row_date['projector'].' Booked By '.$row_date['staffcode'].' For '.$row_date['year'].' '.$row_date['department'].' '.$row_date['section']."<br><br>";}
      	$new_table_row = '<tr><th>'.$row['date'].'</th>';
      	foreach($hours as $hour){
      		$new_table_row .= '<th>'.$hour.'</th>';
      	}
      	$new_table_row .='</tr>';
      	echo $new_table_row;
       }
      }
       else {
          echo "No Results found";
      }
      echo '</table>';
      echo '<div>';
      
      mysqli_close($conn);
      ?>
</html>
