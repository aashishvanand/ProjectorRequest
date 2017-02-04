<?php
   require 'init.php';
   if(isset( $_SESSION['username'])) header('location: home.php');
   ?>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Projector Request</title>
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <div class="login-page">
         <div class="form">
            <img src="img/logo.png" height="200" width="200" >
            <p>Projector Request Login</p>
            <form class="login-form" action="login.php" method = "post">
               <input type="text" placeholder="staffcode" maxlength='5' name='staffcode'/>
               <input type="password" placeholder="password" name='password'/>
               <button type = "submit" name="login" value='login'>login</button>
            </form>
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
         </div>
      </div>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="js/index.js"></script>
   </body>
</html>