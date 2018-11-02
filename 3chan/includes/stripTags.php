<?php
    /*if($page != "b.php"){*/
        $name = strip_tags($name);
        $options = strip_tags($options);
        if(isset($subject)){$subject = strip_tags($subject);}
        $comment = strip_tags($comment);
    /*}else{
        $name = strip_tags($name,"<p><h1><em>");
        $options = strip_tags($options,"<p><h1><em>");
        if(isset($subject)){$subject = strip_tags($subject,"<p><h1><em>");}
        $comment = strip_tags($comment,"<p><h1><em>");
    }*/
?>