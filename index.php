<?php
  session_start();

 include('includes/functions.php');
  //set login error equal to empty
  $loginError = "" ; 

 if(isset($_POST['login']) ){

 	//wrap data with validate function
 	// $formEmail  =  validateFormData( $_POST['email'] );
   // $formPass   =  validateFormData( $_POST['password'] );

  $formEmail  =  $_POST['email'];
  $formPass   =  $_POST['password'];
  

 	//connect to database
 	
 	include('includes/connection.php');

 	//create query
 	$query = " SELECT name, password FROM users WHERE email ='$formEmail' ";

 	//store the result
 	$result = mysqli_query($conn,$query);

 	//verify if result is returned
 	if( mysqli_num_rows($result) > 0){

 		// store some basic user data in some varibles
 		while($row = mysqli_fetch_assoc($result) ){
 			$name       =  $row['name'];
 			$hashedPass =  $row['password'];
 		}

 		//verify hashed password with submitted password
 		 if( password_verify( $formPass, $hashedPass ) ){

 		    //correct login details
 		 	// store data in SESSION variables
      $_SESSION['loggedInUser'] = $name;

 		 	header("location:clients.php");
 		 }else{
 		 	//error message
 		 	$loginError = "<div class='alert alert-danger'>Wrong username/passowrd combination.Try Again Later </div>" ;
 		 }

 	}else{
 		//error message
 		 	$loginError = "<div class='alert alert-danger'>No email in Database.Try Again Later <a class='close' data-dismiss='alert'>&times;</a></div>" ;
 		}
    mysqli_close($conn);
 }

 //close mysqlqi connection


 include('includes/header.php');
 //$password = password_hash("abc123",PASSWORD_DEFAULT);
 //echo $password;
?>



   <body>
    <div class="">
      <div class="container">
        <h1>Login</h1>
        <h1>Client Address Book</h1>
        <p class="lead">Log in into your account.</p>
        <?php echo $loginError; ?>
        <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="form-group">
            <label class="sr-only" for="login-email"></label>
            <input class="form-control" type="email" name="email" id="login-email" placeholder="Email">
          </div>
          <div class="form-group">
            <label class="sr-only" for="login-password"></label>
            <input class="form-control" type="password" name="password" id="login-password" placeholder="Password" value="">
          </div>
          <button class=" btn btn-primary" name="login">Login</button>
          <a href="signUP.php" class="btn btn-default">Register</a>
        </form>
        
      </div> 
    </div>
     
  

      <?php
   include('includes/footer.php');
 ?>
      
   </body>
</html>
 

 