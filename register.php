<?php 
require 'config/config.php';
require 'includes/form_handler/register_handler.php';
require 'includes/form_handler/login_handler.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Our site</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/bootstrap4.min.css">
</head>
<body>

<div class="wrapper">
	<!-- LOGIN FORM -->
 <div class="wrap-login">
 	<div class="heading">
 		<h2 id="heading1">F.R.I.E.N.D.S</h2>
 		<h3 id="heading2">Login or Sign up below</h4>
 	</div>
 	<div class="login" id="login">
		<form action="register.php" method="POST">
		<div class="form-group">
			<input type="email" name="log_email" placeholder="email" class="form-control">
		</div>
		<br>
		<div>
		    <input type="password" name="log_password" placeholder="password" class="form-control">
		</div>
		<br>
		<div>
			<input type="submit" name="log_button" value="login" class="login_btn" >
		</div>
		<a href="#" id="signup" class="signup">Need an account? Register here!</a>
	    </form>
	</div>
	
	<div class="register" id="register">
		<!-- REGISTER FORM -->
		<form  action="register.php" method="POST">
		<!-- first name -->
		<div class="form-group">
			<input type="text" name="reg_fname" class="form-control"placeholder="first name" value=
			"<?php
			  if(isset($_SESSION['reg_fname']))
			  {
			  	echo $_SESSION['reg_fname'];
			  }
			  ?>" required>
		<br>
		<?php
         if(in_array("first name must be between 2 and 25 character", 
         	$error_array)) 
         	echo "first name must be between 2 and 25 character <br>";

   
         if(in_array("first name should only contain alphabets", $error_array)) 
         	echo "first name should only contain alphabets<br>";
		?>
		</div>
		
<!-- 
		last-name -->
		<div class="form-group">
			<input type="text" name="reg_lname" class="form-control" placeholder="last name"value=
			"<?php
			  if(isset($_SESSION['reg_lname']))
			  {
			  	echo $_SESSION['reg_lname'];
			  }
			  ?>" required> 
			<br>
			<?php
	         if(in_array("last name must be between 2 and 25 character", 
	         	$error_array)) 
	         	echo "<div class='error_text'>last name must be between 2 and 25 character</div> <br>";
	       	
	         if(in_array("last name should only contain alphabets", $error_array)) 
	         	echo "last name should only contain alphabets <br>";

		?>
		</div>
		
		<!-- email -->
		<div class="form-group">
			<input type="email" name="reg_email" class="form-control" placeholder="email"
		    value=
			"<?php
			  if(isset($_SESSION['reg_email']))
			  {
			  	echo $_SESSION['reg_email'];
			  }
				  ?>" required>
			<br> 
			<?php
	         if(in_array("email already exists", 
	         	$error_array)) 
	         	echo "email already exists <br>";
	         ?>
		</div>
		
		<!-- //passwords -->
        <div class="form-group">
        	<input type="password" name="reg_password" placeholder="password" class="form-control" required>
			<br>
			<?php
	         // if(in_array("password can contain only english charcters or numbers", 
	         // 	$error_array)) 
	         // 	echo "password can contain only english charcters or numbers <br>";
	         
	         if(in_array("password must be between 8 and 30 characters", 
	         	$error_array)) 
	         	echo "password must be between 8 and 30 characters <br>";
	         if(in_array("passwords don't match", 
	         	$error_array)) 
	         	echo "passwords don't match <br>";
	         ?>
        </div>
		
        <div class="form-group">
        	<input type="password" name="reg_password2" placeholder="confirm password" class="form-control" required>
        </div>
		
		<div class="form-group">
			<input type="submit" name="register_button" value="register" class="login_btn ">
		</div>
	
	    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</span></a>	
	</form>
    
	</div>
    
	

	</div>
 </div>
	
	
    <br><br>
    
</div>
 
<script type="text/javascript" src="assets/javascript/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/javascript/register_script.js"></script>
<?php 
        if (isset($_POST['register_button'])) {
               echo '<script> $(document).ready(function(){ $("#login").hide(); $("#register").show();  }); </script>';
           }
        ?>
</body>
</html>