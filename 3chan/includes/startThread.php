
<div id="startThreadDiv">
    <?php
        
        $_SESSION = array();

        include("simple-php-captcha.php");
        $_SESSION['captcha'] = simple_php_captcha();
        
        $captchaAns = $_SESSION['captcha']['code'];
    
        $hashedCaptchaAns = password_hash($captchaAns,PASSWORD_DEFAULT);
    
    
    if(!isset($_GET['startThread']) && !isset($_GET['startThreadMore'])){
        echo "<p id='startThread'><a href='{$page}?startThread=set'>[start a new thread]</a></p>"; 
    }elseif(isset($_GET['startThreadMore'])){
        
        echo
        "<div id='content'>
        		<form action='{$page}' method='post' enctype='multipart/form-data'>
			<input type='hidden' name='size' value='1000000'>
			<div class='formGrid'>
				<label class='standard' name='name'>Name</label>
				<input type='text' name='name' placeholder='Anonymous'>
				<label class='standard'name='options'>Options</label>
				<input type='text' name='options'>
				<label class='standard' name='subject'>Subject</label>
				<input type='text' name='subject'>
                <label class='standard' name='image'>Image</label>
				<input type='file' name='file'>
                <input type='hidden' name='captchaAns' value='$hashedCaptchaAns'>
                <label class='standard' name='captcha'>Captcha</label>
                <input type='text' name='captcha'>
			</div>

			<div class='formGrid'>
			<label class='comment' name='comment'>Comment</label>
            <textarea class='textArea' rows='4' cols='50' name='comment'></textarea>
            <label class='threadTheme' name='threadTheme'>Thread Theme</label>
            <input type='file' name='audio'>
            <a href='{$page}?startThread=set'>▲</a>
				<input class='submit' name='submit' type='submit' value='submit'>
                <p id='hide'><a href='{$page}'>HIDE</a></p>
			</div>
		</form>
	</div>";
    
        
    }else{
        echo
        "<div id='content'>
        		<form action='{$page}' method='post' enctype='multipart/form-data'>
			    <input type='hidden' name='size' value='1000000'>
                <div class='formGrid'>
				<label class='standard' name='name'>Name</label>
				<input type='text' name='name' placeholder='Anonymous'>
				<label class='standard'name='options'>Options</label>
				<input type='text' name='options'>
				<label class='standard' name='subject'>Subject</label>
				<input type='text' name='subject'>
                <label class='standard' name='image'>Image</label>
				<input type='file' name='file'>
                <input type='hidden' name='captchaAns' value='$hashedCaptchaAns'>
                <label class='standard' name='captcha'>Captcha</label>
                <input type='text' name='captcha'>
			</div>

			<div class='formGrid'>
			<label class='comment' name='comment'>Comment</label>
            <textarea class='textArea' rows='4' cols='50' name='comment'></textarea>
            <a href='{$page}?startThreadMore=set'>▼</a>
				<input class='submit' name='submit' type='submit' value='submit'>
                <p id='hide'><a href='{$page}'>HIDE</a></p>
			</div>
		</form>
	</div>";
       
    }
    
    if(isset($_GET['startThread']) || isset($_GET['startThreadMore'])){
        $src = $_SESSION['captcha']['image_src'];
        echo "<img style='display:block;margin-left: auto;margin-right:auto;' src='$src' alt='Captcha Code'>";
    }
    ?>
</div>

<?php
    ob_start();
    $repliesArraySetter = array();
    $msg = "";
	if(isset($_POST['submit'])){
        
    $captcha = $_POST['captcha'];
    $captchaCompare = $_POST['captchaAns'];

		
	$name = $_POST['name'];
        if($name == ''){
            $name = 'Anonymous';
        }
	$options = $_POST['options'];
	$subject = $_POST['subject'];
	
	$comment = $_POST['comment'];
    $type = 'thread';
        
    
        
    $http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
    $http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote_addr = $_SERVER['REMOTE_ADDR'];
        
    include "stripTags.php";
    include "jsFinder.php";
        

    if(!empty($http_client_ip)){
    $ip_address = $http_client_ip;
    } else if (!empty($http_x_forwarded_for)){
    $ip_address = $http_x_forwarded_for;
    } else {
    $ip_address = $remote_addr;
    }
    
    $file = $_FILES['file'];
    if(!empty($file)){include "imageScrambler.php";}

    $file2 = file_get_contents('includes/banned.txt');    
        if(strstr($file2, $ip_address)){
        echo 'YOU ARE BANNED';
        die();
        }
        
    if($page != 'z.php'){include "spamCheck.php";}
        
    $audioFile = $_FILES['audio'];
    if($audioFile != NULL){include "audioScrambler.php";}

    $cereal = serialize($repliesArraySetter);
        
    include "includes/realEscape.php";
    $comment = " " . $comment . PHP_EOL . " "; //Helps link finder and other similar functions
        
    if($file != NULL){
        if(password_verify($captcha,$captchaCompare)){
            if(!$spam){
            $query = "UPDATE {$postsTable} SET ordid = ordid + 1 WHERE type = '$type'"; //minor change
            $result = mysqli_query($connection,$query);

        
            $query = "INSERT INTO {$postsTable}(ordid,type,name,options,subject,image,comment,threadTheme,replies,ip,captcha) ";
            $query .= "VALUES (1,'$type','$name', '$options', '$subject', '$fileNameNew', '$comment','$fileNameNewAudio','$cereal','$ip_address','$captcha')";  
            $insert_post_query = mysqli_query($connection,$query);

        

            $URL="http://3chan.io/$page";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            }else{
                echo "you're doing that to much, it's time to stop";
                echo "<img src='images/ahahah.gif'>";
                die();
            }
        }else{
            echo "Captcha Incorrect";
            die();
        }
    }else{
        echo "<p align='center' style='color:red;'><b>IMAGE REQUIRED</b></p>";
    }
    }

?>




    <!--  -->