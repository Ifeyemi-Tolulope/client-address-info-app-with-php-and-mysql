<?php
  
// include functions file
include("includes/functions.php");

// connect to database
include("includes/connection.php");
 
$nameError =  $emailError = $passwordError= "" ;

if( isset($_POST['signup'] ) ){
  $passwordREG = $emailREG = $userREG = "";

    // check to see if inputs ar empty 
 	// create variables with form data
 	// wrap the data with our function

        if(!$_POST['username']){
           $nameError ="please enter a username<br>";
        }else{
           $userREG = validateFormData($_POST['username']);
        }
        if(!$_POST['email']){
           $emailError ="Enter your email<br>";
        }else{
           $emailREG = validateFormData($_POST['email']);
        }
        if(!$_POST['password']){
           $passwordError ="please enter password";
        }else{
            //hash password
            $unhashedpassword = $_POST['password'] ;
            $hashedpass = password_hash("$unhashedpassword",PASSWORD_DEFAULT);
            $passwordREG = validateFormData($hashedpass);
                }

    
// if required fields have data
if($userREG && $emailREG && $passwordREG) {

    //create query 
    $query = "INSERT INTO users (id, email, name, password) VALUES (NULL, '$emailREG', '$userREG', '$passwordREG')";
    $result = mysqli_query($conn, $query);

 	//if query was successful
 	if( $result ){

    //refresh page with query string
    header("Location:clients.php?alert=success-welcome");

    }else{
    //something went wrong
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
   
  }

}    
 //close connection
 mysqli_close($conn);

//include header file
  include('includes/header.php');
?>

   <body>
     <div class="container">
       <div>
          <div>
              <h1>Register client to access database</h1>
              <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="form-group row">
                  <div class="form-group">
                  <label for="username" class="">Username </label>
                     <input class="form-control" type="text" name="username" palceholder="" id="username">
                     <small class="text-danger"><?php  echo $nameError;?></small> 
                  </div>
                  <div class="form-group">
                  <label for="email" class="">Email </label>
                     <input class="form-control" type="email" name="email" palceholder="" id="email">
                     <small class="text-danger"><?php  echo $emailError; ?></small>  
                  </div>
                  <div class="form-group">
                      <label for="password" class="">Password </label>
                    <input class="form-control" type="password" name="password" palceholder="" id="password">
                    <small class="text-danger"><?php  echo $passwordError; ?></small> 
                  </div>
                  <div><div>
                  <input type="submit" class="btn btn-primary" vlaue="Sign Up" name="signup">
              </form>
          </div>
        </div>
     </div>
     
   </body>    




