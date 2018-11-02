<?php

function getPostNumb(){
    global $threadsTable, $connection, $repliesTable;
    $query = "SELECT * FROM {$threadsTable}";
    $result = mysqli_query($connection,$query);
    if($result){
        $sum1 = mysqli_num_rows($result);
    }else{
        $sum1 = 0;
    }
    
    $query = "SELECT * FROM {$repliesTable}";
    $result = mysqli_query($connection,$query);
    if($result){
        $sum2 = mysqli_num_rows($result);
    }else{
        $sum2 = 0; 
    }
    
    $sum = $sum1 + $sum2;
    return $sum;


}


?>