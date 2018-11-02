<?php

	if(isset($_POST['username'])){
    $username = $_POST['username'];
	}
    if(isset($_POST['password'])){
    	$password = $_POST['password'];        
    }

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
	<title>3chan.io</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
</head>
<body>
	<h1>3chan</h1>
	<hr>
	<form method="POST" action="validate.php">
		<div id="form_input">
			<input type="username" placeholder="username" name="username">
		</div>
		<div id="form_input">
			<input type="password" placeholder="password" name="password">
		</div>
		<input type="submit" name="submit" value="login" class="btn-login">
		
	</form>

	<hr>

	
    



</body>
</html>

<?php
if(isset($_POST['submit'])){
if ($username == "" || "" && $password == "" or $username == "" || "" && $password == "")
{
	header('location: pol.php');
} 
else
{
	echo "incorrect password";
}
}
?>