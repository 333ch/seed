<?php

session_start();
if($_SESSION['username']){
    echo "Welcome " . $_SESSION['username'];
}
else{
    die();
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
    <div id="nav">
		<ul>
            <li><u><b><a href="a.php">/a/</a></b></u></li>
            <li><u><b><a href="b.php">/b/</a></b></u></li>
            <li><u><b><a href="pol.php">/pol/</a></b></u></li>
            <li><u><b><a href="v.php">/v/</a></b></u></li>
            <li><u><b><a href="tv.php">/tv/</a></b></u></li>
        </ul>
	</div>
    <h1 id='top'>3chan</h1>
   
	
    
	<hr class="aboveTitle">
	<div id="boardTitle">
		<h2 id='headerText'>/b/ - Random</h2>
	</div>
	<hr class="belowTitle">
	<?php
        $connection = mysqli_connect('localhost', '', '', '');
        $postsTable = "postsb";
		$page = "b.php";
        include "includes/getPostNumb.php";
		if(isset($_GET['thread'])){
            include "includes/startReply.php";
        }else{
            include "includes/startThread.php";
        }

	?>
    <!--<hr class="belowForm">-->
    
    <?php
    if(!isset($_GET['thread'])){
        echo "<div id='catalogGrid'>";
        include 'includes/thumbnailMaker.php';
        echo "</div>"; 
    }else{
        include 'includes/threadPage.php';
    }
    ?>
    
    
        
    
   
</body>
</html>