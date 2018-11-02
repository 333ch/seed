<?php

    
    $fileName = $_FILES['audio']['name'];
    $fileTempName = $_FILES['audio']['tmp_name'];
    $fileSize = $_FILES['audio']['size'];
    $fileError = $_FILES['audio']['error'];
    $fileType = $_FILES['audio']['type'];
    
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('mp3');
    
    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            if($fileSize < 30000000){
                $fileNameNewAudio = uniqid('',TRUE).".".$fileActualExt;
                $fileDestination = 'audio/' . $fileNameNewAudio;
                move_uploaded_file($fileTempName,$fileDestination);
                
                
            }else{
                echo "FILE TOO LARGE 300000b limit";
                die();
            }
            
        }else{
            echo "THERE WAS AN ERROR";
            die();
        }
    }else{
        echo "FILE TYPE NOT ALLOWED";
        die();
    }
    
?>