<?php
ob_start(); 
//session_start(); 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$con=mysqli_connect("localhost","root","","social");//connecting to database "social"
if(mysqli_connect_errno())
{
	echo "fail to connect".mysqli_connect_errno();
}
?>