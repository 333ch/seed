<?php


$find = PHP_EOL . ">";
$find2 = PHP_EOL;
$offset = 0;

while($stringPosition = strpos($comment,$find,$offset)){
    
    $offset = $stringPosition + 2;
    
    $stringPosition2 = strpos($comment,$find2,$offset);
    

    $findLength = $stringPosition2 - $stringPosition - 2;


    $greenText = substr($comment,$stringPosition + 2,$findLength);

    
    $styledText = "<p style='color:green;'>$greenText</p>";
    
    
    $findNewLength = strlen($styledText);
    $comment = substr_replace($comment,$styledText,$stringPosition + 3,$findLength);
    
    $offset = $stringPosition + $styledText + 2;

}