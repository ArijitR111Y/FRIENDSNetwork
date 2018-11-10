
<?php
if(isset($_POST["log_button"]))
{
	$email=filter_var($_POST['log_email'],FILTER_SANITIZE_EMAIL);
	$password=sha1($_POST['log_password']);
	$_SESSION['log_email']=$email;
	$check_user_query=mysqli_query($con,"SELECT * FROM user WHERE email='$email' and password='$password'");
	$num=mysqli_num_rows($check_user_query);
	if($num==1)
	{
		$row=mysqli_fetch_array($check_user_query);
		$username=$row['username'];
        $_SESSION['username']=$username;
        header("Location: index.php");
        // require 'index.php';

        exit();
	}

}
?>
