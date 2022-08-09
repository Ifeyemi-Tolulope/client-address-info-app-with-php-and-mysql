<?php
?>
 <!DOCTYPE html>
<html>
   <head>
      <title>Client Address Book</title>
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      
      <!-- Bootstrap -->
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      
      <!--[if lt IE 9]> 
      <script src = "https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src = "https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span> 
               </button>
               <a class="navbar-brand" href="index.php">CLIENT<strong>MANAGER</strong>
               </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
               <?php 
               if($_SESSION['loggedInUser']) { //if user is logged in 
               ?>
               <ul class="nav navbar-nav">
                  <li><a href="clients.php">My Clents</a></li>
                  <li><a href="add.php">Add Clients</a></li>  
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li style="padding-top:15px; color:#fff ;"><?php echo "Hello " .$_SESSION['loggedInUser'] ; ?></li>
                  <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Login Out</a></li>
               </ul>
               <?php 
               }else{ 
               ?>
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login In</a></li>
               </ul>
               <?php 
               } 
               ?>
            </div>
         </div>
      </nav>