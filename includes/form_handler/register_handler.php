<?php
$fname=$lname=$email=$password1=$password2=$date="";
$error_array= array();
if(isset($_POST["register_button"]))//if the button is pressed
{
	//first name:
	$fname=strip_tags($_POST["reg_fname"]);//remove html tags
	$fname=str_replace(" ", "", $fname);//removing spaces
	$fname=ucfirst(strtolower($fname));//uppercase first letter
	$_SESSION["reg_fname"]=$fname;

	//last name
	$lname=strip_tags($_POST["reg_lname"]);//remove html tags
	$lname=str_replace(" ", "", $lname);//removing spaces
	$lname=ucfirst(strtolower($lname));//uppercase first letter
	$_SESSION["reg_lname"]=$lname;

    //email 
    $email=strip_tags($_POST["reg_email"]);
    $_SESSION["reg_email"]=$email;

    //password
	$password1=strip_tags($_POST["reg_password"]);
	$password2=strip_tags($_POST["reg_password2"]);
	$_SESSION["reg_password"]=$password1;
	$_SESSION["reg_password2"]=$password2;

	//date
    $date=date("Y-m-d");//gets the current date

    if($password1!=$password2)
    {
    	array_push($error_array, "passwords don't match");
    }
    if(strlen($password1)>30 || strlen($password1)<8)
    {
    	array_push($error_array,"password must be between 8 and 30 characters");
    }
    // if(!preg_match("/[^A-Za-z0-9]/",$password1))
    // {
    // 	array_push($error_array, "password can contain only english charcters or numbers");
    // }
    if(strlen($fname)>25 || strlen($fname)<2)
    {
    	array_push($error_array, "first name must be between 2 and 25 character");
    }
    if(!preg_match("/^[a-zA-Z]+$/", $fname))
    {
    	array_push($error_array, "first name should only contain alphabets");
    }
    if(strlen($lname)>25 || strlen($lname)<2)
    {
    	array_push($error_array, "last name must be between 2 and 25 character");
    }
     if(!preg_match("/^[a-zA-Z]+$/", $lname))
    {
    	array_push($error_array, "last name should only contain alphabets");
    }
    if(filter_var($email,FILTER_VALIDATE_EMAIL))
    {
    	$email=filter_var($email,FILTER_VALIDATE_EMAIL);//validating email

    	//check if email already exists:
    	$e_check=mysqli_query($con,"SELECT email FROM user WHERE email='$email'");
    	$num_rows=mysqli_num_rows($e_check);
    	if($num_rows>0)
    	{ 
    		array_push($error_array,"email already exists");
    	}

    } 
    
    if(empty($error_array))
    {
    	$password=sha1($password1);//encrypt password before sending to db
    	$check_name=mysqli_query($con,"SELECT first_name,last_name from user where first_name='$fname' and last_name='$lname'");
    	$num=mysqli_num_rows($check_name)+1;
    	$username=strtolower($fname."_".$lname."_".$num);
    //default profile picture:
    	$profile_pic="assets/images/profile_pics/default/p1.jpg";

    //inserting values in table:
    	$query=mysqli_query($con,"INSERT INTO 
    		user (user_id,first_name,last_name,username,email,password,signup_date,profile_pic,num_posts,num_likes,user_closed, friend_array) 
    		VALUES ('','$fname','$lname','$username','$email','$password','$date','$profile_pic','0','0','no',',')");
    	//clear session:
        session_unset();

    	echo "<br><h3 style='color:green'>YOU ARE READY TO LOGIN</h3><br>";


       
    }

}  

?>