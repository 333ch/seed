<?php

$find = ">";
$findOther = ' ';
$findOther2 = '>';
$find2 = PHP_EOL;
$offset = 0;


while($stringPosition = strpos($comment,$find,$offset)){
    $offset = $stringPosition + 1;
    echo "offset" . $offset . " ";
    
    $stringPositionOther = strpos($comment,$findOther,$offset);
    echo "space" . $stringPositionOther . " ";
    $stringPositionOther2 = strpos($comment,$findOther2,$offset);
    echo "arrow" . $stringPositionOther2 . " ";
    
    if($stringPositionOther != $offset && $stringPositionOther2 != $offset){
        $stringPosition2 = strpos($comment,$find2,$offset);
        $findLength = $stringPosition2 - $stringPosition;
    


        $greenText = substr($comment,$stringPosition,$findLength);

    
        $styledText = "<p style='color:green;'>$greenText</p>";
    
    
        $findNewLength = strlen($styledText);
        $comment = substr_replace($comment,$styledText,$stringPosition,$findLength+1);
    
        $offset = $stringPosition + $findNewLength;
    }

}