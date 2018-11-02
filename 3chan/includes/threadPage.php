<?php
    
   
    $query = "SELECT * FROM {$postsTable} WHERE postNumb = {$_GET['thread']}";
    $get_thread_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($get_thread_query)){
        $postNumb = $row['postNumb'];
        $name = $row['name'];
        include "includes/tripCoder.php";
        $timestamp = $row['timestamp'];
        $options = $row['options'];
        $subject = $row['subject'];
        $image = $row['image'];
        $comment = $row['comment'];
        $threadTheme = $row['threadTheme'];
        $get = $_GET['thread'];
        $replyPost = "$page?thread=$get&startReply=set&reply=$postNumb#reply"; //hashtag sets the page at the top
        
        include "replyLinker.php";
        include "linkFinder.php";
        //include "greenArrower.php";
        include "stripTags.php";
        
        
        echo "
        <a href='$page?thread=$get#bottom'>[bottom]</a>
            <div class='wrapperPost'>
                <div class='post'>
                    <div class='header'>
                        <p class='headerRight'>$name: $timestamp</p><p id=$postNumb><a class='postNumb' href='$replyPost'>>>$postNumb</a></p><br>
                        <p class='optionsLeft'$options</p>
	           </div>
	           <div class='header2'>
                    <b>$subject</b>
	           </div>
	           <div class='content'>
	               <a href='images/$image' target='_blank'>
	               <img align='left' src='images/$image'>
	               </a>
                   <div class='textArea' align='left'>$comment</div>
	           </div>
               <div class='repliesFooter'>";
                /*$query = "SELECT * FROM $postsTable WHERE postNumb = $postNumb";
                    $result = mysqli_query($connection,$query);
                    $reply = mysqli_fetch_array($result);
                    $cereal = $reply['replies'];
                    $repliesArray = unserialize($cereal);
        
                    foreach($repliesArray as $key => $replyNumber){
                        echo "<font size='-1'><a href='$page?thread=$get#$replyNumber'>>>$replyNumber</a></font> ";
                    } REPLIES TO THREAD SHOWER FOR OP */
        
        echo    "</div>
            </div>
            </div>";
            
            if($threadTheme != NULL){    
            echo"<div align='center'>
                <audio controls>
                    <source src='audio/$threadTheme' type='audio/mpeg'>
                </audio>
                </div>";
            }
        echo  "<hr>
            ";
                
        } //OP WINDOW

    echo "<a href='$page?thread=$get#bottom'>[BOTTOM]</a>";
        
        
    $query = "SELECT * FROM {$postsTable} WHERE thread = {$_GET['thread']} ORDER BY postNumb";
    $get_replies_query = mysqli_query($connection,$query);

    if($get_replies_query){
    while($row = mysqli_fetch_assoc($get_replies_query)){
        $postNumb = $row['postNumb'];
        $name = $row['name'];
        include "includes/tripCoder.php";
        $timestamp = $row['timestamp'];
        $options = $row['options'];
        $image = $row['image'];
        $comment = $row['comment'];
        $get = $_GET['thread'];
        $replyPost = "$page?thread=$get&startReply=set&reply=$postNumb#headerText";
        
        include "replyLinker.php";
        include "linkFinder.php";
        //include "greenArrower.php";
        
        
        
        echo "
        <div id=$postNumb></div>
            <div class='wrapperPost'>
                <div class='post'>
                    <div class='header'>
                        $name: $timestamp<a class='postNumb' href='$replyPost'>>>$postNumb</a><br>
                        <p class='optionsLeft'>$options</p>
	                </div>
	               <div class='content'>";
        if($image){
                echo "
                    <a href='images/$image' target='_blank'>
                        <img align='left' src='images/$image'>
                    </a>
                    ";
            }
        
	               
        echo "
                        <div class='textArea' align='left'>$comment</div>
                    </div>
                    <div class='repliesFooter'>";
                    $query = "SELECT * FROM $postsTable WHERE postNumb = $postNumb";
                    $result = mysqli_query($connection,$query);
                    $reply = mysqli_fetch_array($result);
                    $cereal = $reply['replies'];
                    $repliesArray = unserialize($cereal);
        
                    foreach($repliesArray as $key => $replyNumber){
                        echo "<font size='-1'><a href='$page?thread=$get#$replyNumber'>>>$replyNumber</a></font> ";
                    }
                    
                    
        
        echo            "</div>
                </div>
            </div>
            <br>
                ";
                
        }
    
    }
    
    
?>

<p align="center" id="bottom"><a href="<?php echo $page . "?thread=" . $get . "#top"; ?>">[top]</a> <a href="<?php echo $page . "?thread=" . $get . "#bottom"; ?>">[update]</a> <a href='<?php echo $page; ?>'>[return]</a></p>
