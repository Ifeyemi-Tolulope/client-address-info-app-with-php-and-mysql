
<?php 

session_start();
//did the user browser send a cookie for the session
if (isset( $_COOKIE[ session_name() ] ) ){

  //empty the cookie
  setcookie( session_name(), '', time()-86400, '/');
 } 


 
//clear all session variables
 session_unset();
// destroy the session
 session_destroy();

 include ('includes/header.php');
 ?>


<div class="container-fluid">
<h1>Logged Out</h1>

<p class="Lead"> You've  been out. See you next time!</p>

<?php include ('includes/footer.php');  ?>
</div>