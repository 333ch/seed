<?php

//$name input come from what the user entered for the name value

$stringLength = strlen($name);
$first2 = substr($name,0,2);

if($first2 == "##"){
    $strip = substr($name,2,$stringLength);
    $md5 = md5("$strip");
    $name = substr($md5,2,7);
    
    $name = "<p style='color:#88D89E;font-weight: bold;font-size:25px;display:inline-block'>" . $name . "</p>";

}

?>
