<?php

    
    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg','jpeg','png','gif','.webm','');
    
    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            if($fileSize < 30000000){
                $fileNameNew = uniqid('',TRUE).".".$fileActualExt;
                $fileDestination = 'images/' . $fileNameNew;
                move_uploaded_file($fileTempName,$fileDestination);
                
                
            }else{
                /*echo "FILE TOO LARGE 300000b limit";
                die();*/
            }
            
        }else{
            /*echo "THERE WAS AN ERROR";
            die();*/
        }
    }else{
        echo "FILE TYPE NOT ALLOWED";
        die();
    }
    
?>