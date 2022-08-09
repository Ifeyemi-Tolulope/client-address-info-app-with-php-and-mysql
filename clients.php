<?php 
session_start();

//if user not logged in
if(! $_SESSION['loggedInUser']){
  // send them to the login page if not looged in 
  header("Location:index.php");
}
// connect o databse
 include('includes/connection.php');

 $query = "SELECT * FROM clients";
 $result = mysqli_query($conn, $query);

 $alertMessage="";
 //check for query string
 if (isset( $_GET['alert'] ) ) {

  
  // new client added.....
  if ($_GET['alert'] == 'success' ) {
    $alertMessage = "<div class='alert alert-success'>New Client added!<a class='close' data-dismiss='alert'>&times;</a></div>";
    //client updated.......
  }elseif($_GET['alert'] == 'updatesuccess' ){
     $alertMessage = "<div class='alert alert-success'>Client updated<a class='close' data-dismiss='alert'>&times;</a></div>";
     //client deleted......
  }elseif($_GET['alert'] == 'deleted'){
    $alertMessage = "<div class='alert alert-success'>Client deleted!<a class='close' data-dismiss='alert'>&times;</a></div>";
  }elseif($_GET['alert'] == 'success-welcome' ){
   // new user created.....
    $alertMessage = "<div class='alert alert-success'>Welcome!<a class='close' data-dismiss='alert'>&times;</a></div>";
 }
 }

include('includes/header.php');
  ?>
  <div class="container-fluid">
  <h1>Client Address Book</h1>
  <?php echo "$alertMessage"; ?>
  <table class=" table table-striped table-bordered">

    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Company</th>
      <th>Notes</th>
      <th>Edit</th>
    </tr>

    <?php
      if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result) ) {
          echo "<tr>";
          echo "<td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['address'] . "</td><td>" . $row['company'] . "</td><td>" . $row['notes'] . "</td>";
           echo '<td><a href="edit.php?id=' . $row['id'] . '" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span>
           </a></td>';
          echo "</tr>";
        }
      }else{
        echo'<div class="alert alert-warning" >You have No clients!</div>';
      }
      //close the connection
      mysqli_close($conn);
    ?>
    <tr>
      <td class="text-center" colspan="11"><div><a class="btn btn-sm btn-success" href="add.php" type="button"><span class="glyphicon glyphicon-plus">Add Cient</span></a></div></td>
    </tr>
  </table>
</div>

  <?php //include('includes/footer.php'); ?>