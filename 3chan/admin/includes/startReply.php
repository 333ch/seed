<div id="startThreadDiv">
    <?php
    $get = $_GET['thread'];

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
                <input type='file' name='image'>
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
    }
    ?>
</div>

<?php
    
$repliesArraySetter = array();
$msg = "";    
if(isset($_POST['submit2'])){
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

    $image = $_FILES['image']['name'];
    $comment = $_POST['comment'];
    $type = 'reply';
    
    
    
    include "realEscape.php";
    $comment = " " . $comment . PHP_EOL . " "; //Helps link finder and other similar functions
    
    $cereal = serialize($repliesArraySetter);
    $query = "INSERT INTO {$postsTable}(type,thread,name,options,image,comment,replies) ";
    $query .= "VALUES ('$type',$get,'$name','$options','$image','$comment','$cereal')";  //$cereal sets replies column to an empty array
    $result = mysqli_query($connection,$query);
    
    include "postReplies.php";

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $msg = "Image uploaded successfully";
        } else {
        $msg = "FAIL";
        }
    
        echo "<p align='center'>REPLY SUCCESSFUL</p>";
        
        
        if(!$sage){
            $query = "UPDATE {$postsTable} SET ordid = 0 WHERE postNumb = $get";
            $result = mysqli_query($connection,$query);
            $query = "UPDATE {$postsTable} SET ordid = ordid + 1 WHERE type = 'thread'"; //minor change
            $result = mysqli_query($connection,$query);
        }
    }
?>