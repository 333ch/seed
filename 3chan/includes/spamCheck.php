<?php

$query = "SELECT * FROM $postsTable ORDER BY postNumb DESC LIMIT 10";
$result = mysqli_query($connection,$query);

$ipArray = array();

while($row = mysqli_fetch_assoc($result)){
    
    $ip = $row['ip'];
    
    if($ip == $ip_address){
        $ipArray[] = TRUE;
    }else{
        $ipArray[] = FALSE;
    }     
}

if(array_sum($ipArray) == count($ipArray)) {
    $spam = TRUE;
} else {
    $spam = FALSE;

}
?>