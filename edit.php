<?php
session_start();

 //if user is not logged in
   if( !$_SESSION['loggedInUser'] ){
   	//send them to the login page
   	header('Location:index.php');
   } 

//get ID sent by GET collection
$clientID = $_GET['id'];
// connect to database
include("includes/connection.php");

// include functions file
include("includes/functions.php");

// query the databse with clent ID
$query = "SELECT * FROM clients WHERE id ='$clientID'";
$result = mysqli_query($conn, $query);

//if result is returned
if( mysqli_num_rows($result) > 0 ) {
	//we have data
	// set some variables
	while( $row = mysqli_fetch_assoc($result) ) {
		$clientName     = $row['name'];
		$clientEmail    = $row['email'];
		$clientPhone    = $row['phone'];
		$clientAddress  = $row['address'];
		$clientCompany  = $row['company'];
		$clientNotes    = $row['notes'];
	}
}else{
	// no result returned
	$alertMessage = "<div class='alert alert-warning'>there is nothing to see <a href='clients.php'>Head back</a></div>";
}


$nameError = $emailError = "";
 if( isset($_POST['update'] ) ) {
 	
		// set some varibles
	if (empty($_POST['clientName'])) {
 		$nameError = "please enter a name <br>";
 	}else{
 		$clientName = validateFormData( $_POST["clientName"]);
 	}
	if ( !$_POST['clientEmail']) {
 		$emailError = "please enter an email <br>";
 	}else{
 		$clientEmail = validateFormData( $_POST["clientEmail"]);
 	}
	$clientPhone   = validateFormData($_POST["clientPhone"]);
	$clientAddress = validateFormData($_POST["clientAddress"]);
	$clientCompany = validateFormData($_POST["clientCompany"]);
	$clientNotes = validateFormData($_POST["clientNotes"]);
	

 
 // if required fields have data
 	if( $clientName && $clientEmail ){

	// new database query & result
	$query = "UPDATE clients
	        SET name = '$clientName',
	        email='$clientEmail',
	        phone='$clientPhone',
	        address='$clientAddress',
	        company='$clientCompany',
	        notes='$clientNotes'
	        WHERE clients . id = '$clientID'";

	$result = mysqli_query($conn, $query);
	
	if( $result )  {
		 //redirect the client page with query string
		header('Location:clients.php?alert=updatesuccess');
	}else{
		echo "Error updating record " . mysqli_Error($conn);
	}    
}
}

$alertMessage="";
if(isset($_POST['delete'])){
	$alertMessage = "<div class='alert alert-danger'>
	<p> Are you sure you wanty to delete this client? No take backs!!</p><br>
	<form action='". htmlspecialchars($_SERVER['PHP_SELF']) ."?id=$clientID' method='post'>
        <input name='confirm-delete' type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete!''>
        <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Ooops, no thanks!</a>
	</form>
	</div>";
}

//if confirm delete button was submitted
 if ( isset( $_POST['confirm-delete'] ) ) {

 	$query =" DELETE FROM clients WHERE id=$clientID";
 	$result = mysqli_query($conn, $query);

 	if($result){
 		//redirect to client page with query string
 		header("Location: clients.php?alert=deleted");
 	}else{
 		echo "Error updating record " . mysqli_Error($conn);
 	}
 }

 // close the mysqli connection
 mysqli_close($conn);

include('includes/header.php');
?>

<div class="container">
	<h1>Edit Clients</h1>
	<?php echo $alertMessage ?>
	<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $clientID; ?>"" method="post" class="row">
		<div class="form-group col-sm-6">
			<label for="client-name">Name <span class="text-danger">*</span></label>
			<input class="form-control input-lg" type="text" name="clientName" id="client-name" value="<?php echo $clientName; ?> ">
			<small class="text-danger"><?php echo $nameError;?></small>
		</div>
		<div class="form-group col-sm-6">
			<label for="client-email">Email <span class="text-danger">*</span></label>
			<input class="form-control input-lg" type="email" name="clientEmail" id="client-email" value="<?php echo $clientEmail; ?>">
			<small class="text-danger"><?php echo $emailError;?></small>
		</div>
		<div class="form-group col-sm-6">
			<label for="client-phone">Phone</label>
			<input class="form-control input-lg" type="text" name="clientPhone" id="client-phone" value="<?php echo $clientPhone; ?>" >
		</div>
		<div class="form-group col-sm-6">
			<label for="client-address">Address</label>
			<input class="form-control" type="text" name="clientAddress" id="client-address" value="<?php echo $clientAddress; ?> ">
		</div>
		<div class="form-group col-sm-6">
			<label for="client-company">Company</label>
			<input class="form-control input-lg" type="text" name="clientCompany" id="client-company" value="<?php echo $clientCompany; ?> ">
		</div>
		<div class="form-group col-sm-6">
			<label for="client-note">Notes</label>
			<textarea class="form-control input-lg" id="client-notes" name="clientNotes"> <?php echo $clientNotes; ?> </textarea>
		</div>
		<div class="col-sm-12">
			<br>
			<button class="btn btn-lg btn-danger pull-left" name="delete">Delete
			</button>
			<div class="pull-right">
				<a href="clients.php" type="button" class="btn btn-lg btn-default">Cancel</a>
				<button class="btn btn-lg btn-success " name="update">Update</button>
			</div>
		</div>

	</form>
</div>