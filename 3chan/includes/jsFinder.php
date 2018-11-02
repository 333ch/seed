<?php


$find = "javascript:location";
$find2 = " ";
$find3 = PHP_EOL;
$offset = 0;

while($stringPosition = strpos($comment,$find,$offset)){
    die();
    $offset = $stringPosition;
    
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

    $findLength = $next - $stringPosition;


    $URL = substr($comment,$stringPosition,$findLength);

    
    $link = "<u><a href='$URL' target='_blank'>$URL</a></u>";
    
    
    $linkLength = strlen($link);
    if(!$space){
        $comment = substr_replace($comment,$link,$stringPosition,$findLength + 1);
    }else{
        $comment = substr_replace($comment,$link,$stringPosition,$findLength);
    }
    $offset = $stringPosition + $linkLength;

}


?>