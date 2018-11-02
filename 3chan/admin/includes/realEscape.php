<?php
    $name = mysqli_real_escape_string($connection,$name);
	$options = mysqli_real_escape_string($connection,$options);
	if(isset($subject)){$subject = mysqli_real_escape_string($connection,$subject);}
	$comment = mysqli_real_escape_string($connection,$comment);
?>