<?php



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
    

    $link = "<u><a href='$page?thread=$get#$replyNumber'>>>$replyNumber</a></u>";
    $linkLength = strlen($link);
    
    if(!$space){
        $comment = substr_replace($comment,$link,$stringPosition,$findLength2 + 1);
    }else{
        $comment = substr_replace($comment,$link,$stringPosition,$findLength2);
    }
    $offset = $stringPosition + $linkLength;

}



?>