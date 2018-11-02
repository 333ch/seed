
<div id="startThreadDiv">
    <?php
    if(!isset($_GET['startThread'])){
        echo "<p id='startThread'><a href='{$page}?startThread=set'>[start a new thread]</a></p>"; 
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
				<input type='file' name='image'>
			</div>

			<div class='formGrid'>
			<label class='comment' name='comment'>Comment</label>
				<textarea class='textArea' rows='4' cols='50' name='comment'></textarea>
				<input class='submit' name='submit' type='submit' value='submit'>
                <p id='hide'><a href='{$page}'>HIDE</a></p>
			</div>
		</form>
	</div>";
    }
    ?>
</div>

<?php
    
    
    $repliesArraySetter = array();
    $msg = "";
	if(isset($_POST['submit'])){
		$target = "images/".basename($_FILES['image']['name']);
	$name = $_POST['name'];
        if($name == ''){
            $name = 'Anonymous';
        }
	$options = $_POST['options'];
	$subject = $_POST['subject'];
	$image = $_FILES['image']['name'];
	$comment = $_POST['comment'];
    $type = 'thread';

    $cereal = serialize($repliesArraySetter);
        
    include "includes/realEscape.php";
    $comment = " " . $comment . PHP_EOL . " "; //Helps link finder and other similar functions
        
    if($image != NULL){
        $query = "UPDATE {$postsTable} SET ordid = ordid + 1 WHERE type = '$type'"; //minor change
        $result = mysqli_query($connection,$query);

        
        $query = "INSERT INTO {$postsTable}(ordid,type,name,options,subject,image,comment,replies) ";
        $query .= "VALUES (1,'$type','$name', '$options', '$subject', '$image', '$comment','$cereal')";  
        $insert_post_query = mysqli_query($connection,$query);

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $msg = "Image uploaded successfully";
            } else {
            $msg = "FAIL";
            }

        echo "<p align='center'>POST SUCCESSFUL</p>";   

        }else{
            echo "<p align='center' style='color:red;'><b>IMAGE REQUIRED</b></p>";
    }
    }
?>




    <!--  -->