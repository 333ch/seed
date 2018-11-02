<?php
$username = $_POST['username'];
$password = $_POST['password'];
if(isset($_POST['submit'])){
	if ($username == "" || "" && $password == "" or $username == "" || "" && $password == "")
{
	session_start();
	$_SESSION['username'] = $username;
	header("location: pol.php");
} 
	else
{
	echo "incorrect password";
}
}
?>