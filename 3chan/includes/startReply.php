<div id="startThreadDiv">
    <?php
    $get = $_GET['thread'];
        
        $_SESSION = array();

        include("simple-php-captcha.php");
        $_SESSION['captcha'] = simple_php_captcha();
        
        $captchaAns = $_SESSION['captcha']['code'];
    
        $hashedCaptchaAns = password_hash($captchaAns,PASSWORD_DEFAULT);

    if(!isset($_GET['startReply'])){
        echo "<p id='startThread'><a id='reply' href='{$page}?startReply=set&thread=$get'>[reply]</a></p>"; 
    }else{
        echo
        "<div>
        <div id='content'>
                <form action='$page?thread=$get' method='post' enctype='multipart/form-data'>
            <input type='hidden' name='size' value='1000000'>
            <div class='formGrid'>
                <label class='standard' name='name'>Name</label>
                <input type='text' name='name' placeholder='Anonymous'>
                <label class='standard'name='options'>Options</label>
                <input type='text' name='options'>
                <label class='standard' name='image'>Image</label>
                <input type='file' name='file'>
                <input type='hidden' name='captchaAns' value='$hashedCaptchaAns'>
                <label class='standard' name='captcha'>Captcha</label>
                <input type='text' name='captcha'>
            </div>
            <div class='formGrid'>
            <label class='comment' name='comment'>Comment</label>
                <textarea class='textArea' rows='4' cols='50' name='comment'>";
            if(isset($_GET['reply'])){
               echo ">>" . $_GET['reply'];
            }
        echo
            "</textarea>
                <input class='submit' name='submit2' type='submit' value='submit'>
                <p id='hide'><a href='$page?thread=$get'>HIDE</a></p>
            </div>
        </form>
    </div>";
        
        $src = $_SESSION['captcha']['image_src'];
        echo "<img style='display:block;margin-left: auto;margin-right:auto;' src='$src' alt='Captcha Code'>";
    
    }
    ?>
</div>

<?php

    
$repliesArraySetter = array();
$msg = "";    
if(isset($_POST['submit2'])){
    $captcha = $_POST['captcha'];
    $captchaCompare = $_POST['captchaAns'];
    
    $target = "images/".basename($_FILES['image']['name']);
    $name = $_POST['name'];
        if($name == ''){
            $name = 'Anonymous';
        }
    $options = $_POST['options'];
        if($options == 'sage'){
            $sage = true;
        }elseif($options == 'Sage'){
            $sage = true;
        }else{
            $sage = false;
        }

    include "imageScrambler.php";
    
    $comment = $_POST['comment'];
    $type = 'reply';
    $http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
    $http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote_addr = $_SERVER['REMOTE_ADDR'];

    if(!empty($http_client_ip)){
    $ip_address = $http_client_ip;
    } else if (!empty($http_x_forwarded_for)){
    $ip_address = $http_x_forwarded_for;
    } else {
    $ip_address = $remote_addr;
    }
    
    include "stripTags.php";
    include "jsFinder.php";
    
    $file = file_get_contents('includes/banned.txt');

        if(strstr($file, $ip_address)){
        echo "YOU ARE BANNED";
            die();
}
    include "spamCheck.php";
    
    if(password_verify($captcha,$captchaCompare)){
        if(!$spam){
        include "realEscape.php";
        $comment = " " . $comment . " " . PHP_EOL; //Helps link finder and other similar functions
    
        $cereal = serialize($repliesArraySetter); //turns reply array into string for phpmyadmin storage into a single row column
        $query = "INSERT INTO {$postsTable}(type,thread,name,options,image,comment,replies,ip) ";
        $query .= "VALUES ('$type',$get,'$name','$options','$fileNameNew','$comment','$cereal','$ip_address')";  //$cereal sets replies column to an empty array
        $result = mysqli_query($connection,$query);
    
        include "postReplies.php";
    
        $URL="http://3chan.io/$page?thread={$_GET['thread']}";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">'; 

    
    
            echo "<p align='center'>REPLY SUCCESSFUL</p>";
        
        
            if(!$sage){
                $query = "UPDATE {$postsTable} SET ordid = 0 WHERE postNumb = $get";
                $result = mysqli_query($connection,$query);
                $query = "UPDATE {$postsTable} SET ordid = ordid + 1 WHERE type = 'thread'"; //minor change
                $result = mysqli_query($connection,$query);
            }
        }else{
            echo "you're doing that to much, it's time to stop";
            echo "<img src='images/ahahah.gif'>";
            die();
        }
        }else{
        echo "captcha incorrect";
        die();
    }
    }
?>