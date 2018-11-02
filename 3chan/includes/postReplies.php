<?php

$query = "SELECT * FROM $postsTable WHERE postNumb = (SELECT max(postNumb) FROM $postsTable)";
$get_latest_post = mysqli_query($connection,$query);
$reply = mysqli_fetch_array($get_latest_post);
$comment = $reply['comment'];
$postNumb = $reply['postNumb'];


$find = ">>";
$find2 = " ";
$find3 = PHP_EOL;
$offset = 0;


while($stringPosition = strpos($comment,$find,$offset)){    

    $offset = $stringPosition + 2;
    $stringPosition2 = strpos($comment,$find2,$offset);
    $stringPosition3 = strpos($comment,$find3,$offset);
    
    
    if($stringPosition2 < $stringPosition3){
        $next = $stringPosition2;
        $space = TRUE;
    }elseif($stringPosition3 == NULL){
        $next = $stringPosition2;
        $space = TRUE;
    }else{
        $next = $stringPosition3;
        $space = FALSE;
    }
    

    $findLength = $next - $stringPosition - 2;

    $findLength2 = $next - $stringPosition;

    $replyNumber = substr($comment,$stringPosition + 2,$findLength);

    
    //****************************
    
    $query = "SELECT replies FROM $postsTable WHERE postNumb = $replyNumber";
    $get_replies_query = mysqli_query($connection,$query);
    $reply = mysqli_fetch_array($get_replies_query);
    $cereal = $reply['replies'];
    
    $repliesArray = unserialize($cereal);

    $repliesArray[] = $postNumb;
    
    $cereal = serialize($repliesArray);
    
    $query = "UPDATE {$postsTable} SET replies = '$cereal' WHERE postNumb = $replyNumber";
    $result = mysqli_query($connection,$query);
    
    //**********************************
    
    $offset = $stringPosition + 2;


}





?>