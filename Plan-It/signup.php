<?php
$showAlert1=false;
$showAlert2=false;
$showAlert3=false;

session_start();
//Database connection
include('partials/_dbconnect.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

$fname = $_POST['FirstName'];
$lname = $_POST['LastName'];
$email = $_POST['EmailId'];
$contact = $_POST['ContactNo'];
$password = $_POST['Password'];
$cpassword = $_POST['ConfirmPassword'];


$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

$sql = "SELECT * from user where email_id = '$email' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
// if account does not already exist in the database
if ($count == 0) {
	// if password fulfills all the password requirements
	if($uppercase && $lowercase && $number && $specialChars && strlen($password) >=8) {

        //if password and confirm password match
		if ($password == $cpassword){
			$query1="INSERT INTO `user` (`email_id`, `firstName`, `lastName`, `contact`, `password`) VALUES ('$email', '$fname', '$lname', '$contact', '$password')";
			mysqli_query($conn, $query1);
			$_SESSION['email'] = $email;
			echo "<script>location='login.php'</script>";
		 
		}
		else {
			$showAlert3="Password and Confirm Password fields do not match!";
			
	}}
       
    else {
		$showAlert2="Password should be at least 8 characters in length and should include
		at least one upper case letter, one number, and one special character.";
	}
}
else{
    $showAlert1="Account already exist";
}
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    
<?php require '<partials/_styling.php';?>

</head>

<body>

<?php require '<partials/_header.php';?>
<?php

if($showAlert1){
echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error!</strong> '. $showAlert1.'
</div>';
}

if($showAlert2){
	echo'<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error!</strong> '. $showAlert2.'
</div>';
}

if($showAlert3){
echo '<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error!</strong> '. $showAlert3.'
</div>';
}

?>
<div class="container">
	<div class="heading col-md-7" style="text-align: justify;">Plan It 
		<p>In this fast-paced, keeping track of our tasks and their relevant deadlines is not an easy feat. Plan It serves as an assisting application to provide users ease in maintaining all of their important tasks in one place.</p>
	</div>
	<div class="card" style="width: 30rem; left: 700px; border: 2px solid rgba(196, 182, 218, 0.87);">
		<div class="card-body"; style="text-align:center";>
			<h2 class="card-title">Sign Up</h2>

			<form  method="POST" >
				<div class="form-group">
				
					<input type="text" class="form-control" id="FirstName" name="FirstName"
						placeholder="First Name" required>
					
				
				</div>
				<div class="form-group">
				
					<input type="text" class="form-control" id="LastName"  name="LastName" placeholder="Last Name" required>
					
				
				</div>
				<div class="form-group">
					
					<input type="email" class="form-control" id="EmailId" name="EmailId" aria-describedby="emailHelp"
						placeholder="Enter email" required>
					
				
				</div>
				<div class="form-group">
				
					<input type="tel" pattern="[0-9]{4}-[0-9]{7}" class="form-control" id="ContactNo" name="ContactNo" placeholder="Contact Number" required>
					<small>Format: 03XX-XXXXXXX</small>
					
				</div>
				<div class="form-group">
					
					<input type="password" class="form-control" id="inputValidationEx2" name="Password" placeholder="Password" required>
					<label for="inputValidationEx2" data-error="wrong" data-success="right" style="width:200px;"><small>Type your password</small></label>

					
				</div>
				<div class="form-group">
				
					<input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm Password" required>
					
				</div>
				<button type="submit" class="btn">Sign Up</button>
				
			</form>
			
			<a style="color: #301b52;" href="login.php">Already Have An Account?</a>
		</div>
	</div>

</div>

</body>

</html>