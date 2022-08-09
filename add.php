<?php
 session_start();

 
 //return to login page if user is not logged in
if (!$_SESSION['loggedInUser']) {
	header("Location:index.php");
}

// connect o database
include("includes/connection.php");

// include functions file
include("includes/functions.php");

$nameError = $emailError = "";
//if add button is summitted
 if( isset($_POST['add'] ) ){
 	// set all variables to empty by default
 	$clientName =$clientEmail = $clientPhone = $clientAddress = $clientCompany = $clientNote = "";
 	// check to see if inputs ar empty 
 	// create variables with form data
 	// wrap the data with our function

 	if ( !$_POST["clientName"]) {
 		$nameError = "please enter a name <br>";
 	}else{
 		$clientName = validateFormData( $_POST["clientName"]);
 	}
 	if ( !$_POST["clientEmail"]) {
 		$emailError = "please enter an email <br>";
 	}else{
 		$clientEmail = validateFormData( $_POST["clientEmail"]);
 	}
 	
 	//these inputs are not required
 	//it will store whatever way it is submitted
 	$clientPhone    = validateFormData( $_POST["clientPhone"] );
 	$clientAddress  = validateFormData( $_POST["clientAddress"] );
 	$clientCompany  = validateFormData( $_POST["clientCompany"] );
 	$clientNote     = validateFormData( $_POST["clientNote"] );

 		// if required fields have data
 	if( $clientName && $clientEmail ){
 		 
 		//create query 
 		$query = "INSERT INTO clients (id, name, email, phone, address, company, notes, date_added) VALUES (NULL, '$clientName;', '$clientEmail' ,'$clientPhone','$clientAddress','$clientCompany','$clientNote', CURRENT_TIMESTAMP)";

 		$result = mysqli_query( $conn, $query );

 		//if query was succesful
 		if( $result ){

 		// refresh page with query string
 			header("Location:clients.php?alert=success");
 		}else{
 			//something went wrong
 			echo "Error: " . $query . "<br>" . mysqli_error($conn);
 		}


 	}

 }

// close mysqli connection
 mysqli_close($conn);
include('includes/header.php');
?>

<div class="container-fluid">
<h1>Add Clients</h1>
<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ) ?>" method="post" class="row">
	<div class="form-group col-sm-6">
		<label for="client-name">Name <span class="text-danger">*</span></label>
		<input class="form-control" type="text" name="clientName" id="client-name" value="">
		<small class="text-danger"><?php echo $nameError;?></small>
	</div>
	<div class="form-group col-sm-6">
		<label for="client-email">Email <span class="text-danger">*</span></label>
		<input class="form-control" type="email" name="clientEmail" id="client-email" value="">
		<small class="text-danger"><?php echo $emailError; ?></small>
	</div>
	<div class="form-group col-sm-6">
		<label for="client-phone">Phone</label>
		<input class="form-control" type="text" name="clientPhone" id="client-phone" value="">
	</div>
	<div class="form-group col-sm-6">
		<label for="client-address">Address</label>
		<input class="form-control" type="text" name="clientAddress" id="client-address" value="">
	</div>
	<div class="form-group col-sm-6">
		<label for="client-company">Company</label>
		<input class="form-control" type="text" name="clientCompany" id="client-company" value="">
	</div>
	<div class="form-group col-sm-6">
		<label for="client-note">Notes</label>
		<textarea class="form-control input-lg" id="client-note" name="clientNote" value=""></textarea>
	</div>
	<div class="col-sm-12">
		<a href="clients.php" type="button" class="btn btn-lg btn-default">Cancel</a>
		<button class="btn btn-lg btn-success pull-right" name="add">Add client</button>
	</div>

</form>
</div>