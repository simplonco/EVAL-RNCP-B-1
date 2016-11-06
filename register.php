<?php
session_start();

if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
	$birth_date = mysqli_real_escape_string($con, $_POST['birth_date']);
	$countries = mysqli_real_escape_string($con, $_POST['countries']);
	$asylum_number = mysqli_real_escape_string($con, $_POST['asylum_number']);
	$casylum_number = mysqli_real_escape_string($con, $_POST['casylum_number']);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$first_name)) {
		$error = true;
		$first_name_error = "Name must contain only alphabets and space";
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$last_name)) {
		$error = true;
		$last_name_error = "Name must contain only alphabets and space";
	}
	
	if(strlen($asylum_number) > 5) {
		$error = true;
		$asylum_number_error = "Asylum number must have not greater than five";
	}
	if($asylum_number != $casylum_number) {
		$error = true;
		$casylum_number_error = "Asylum number and Confirm Asylum number doesn't match";
	}
	//If I want to protect my password, I can use md5. Like this 
	// md5($password) instead of $password
	if (!$error) {
		if(mysqli_query($con, "INSERT INTO users(first_name,last_name,birth_date,countries,asylum_number) VALUES('" . $first_name . "','" . $last_name . "','" . $birth_date . "','" . $countries . "','" . $asylum_number . "')")) {
			$successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
		} else {
			$errormsg = "Error in registering...Please try again later!";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Page</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/logo_secours_catholique.png"></a>
		</div>
		<!-- menu items -->
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				
				<li class="active"><a href="register.php">Sign Up</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well" id="well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>

					<div class="form-group">
						<label for="name">First Name</label>
						<input type="text" name="first_name" placeholder="Your First Name" required value="<?php if($error) echo $first_name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($first_name_error)) echo $first_name_error; ?></span>
					</div>
					<div class="form-group">
						<label for="name">Last Name</label>
						<input type="text" name="last_name" placeholder="Your Last Name" required value="<?php if($error) echo $last_name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($last_name_error)) echo $last_name_error; ?></span>
					</div>
					<div class="form-group">
						<label>Date of Birth</label><br>
						    <?php
									
							// month array 
			
						$month = array( 1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
												
							echo '<select name="' . $month . '">';	

							foreach ( $month as $k => $v ) {

								echo '<option name="'. $v . '"  value="' . $k . '">' . $v . '</option><br />';
							}
							
							echo '</select>&nbsp;<select name="day">';
								
							for ( $i = 1; $i <= 31; $i++) {
										
					                     echo '<option name="'. $i . '"  value="' . $i . '">' . $i . '</option><br />';

							}
								
						
							echo '</select>&nbsp;<select name="year">';
								
							for ( $i = 1950; $i <= 2050; $i++) {
								echo '<option name="'. $i . '"  value="' . $i . '">' . $i . '</option><br />';

							}
								
							echo '</select>';
										
						?>	<br>	
						
					</div>
					<div class="form-group">
						<label for="name">Your Country</label>
						<select name="countries">
						<?php

						include 'country.php';


						foreach($countries as $key => $value) {
						?>
						
						<option value="<?= $value ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
						<?php
						}
						?>
					</select>
					
					</div>					

					<div class="form-group">
						<label for="name">Asylum Number</label>
						<input type="password" name="asylum_number" placeholder="Asylum Number" required class="form-control" />
						<span class="text-danger"><?php if (isset($asylum_number_error)) echo $asylum_number_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Confirm Asylum Number</label>

						<input type="password" name="casylum_number" placeholder="Confirm Asylum Number" required class="form-control" />
						<span class="text-danger"><?php if (isset($casylum_number_error)) echo $casylum_number_error; ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="login.php">Login Here</a>
		</div>
	</div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



