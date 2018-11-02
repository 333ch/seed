<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
<?php
    
    
    
    
    $query = "SELECT * FROM {$postsTable} WHERE type = 'sticky'";
    $select_all_threads_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_threads_query)){
        $postNumb = $row['postNumb'];
        $name = $row['name'];
        $options = $row['options'];
        $subject = $row['subject'];
        $image = $row['image'];
        $comment = $row['comment'];
        
        echo "
        <a href='{$page}?thread={$postNumb}'>
            <div id='thumbnail'>
                <img src='../images/{$image}' class='thumbnailImg'>
                <b>{$subject}</b>
                <p>{$comment}</p>
            </div>
        </a>
            ";
        
    }
    
    $query = "SELECT * FROM {$postsTable} WHERE type = 'thread' ORDER BY ordid";
    $select_all_threads_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_threads_query)){
        $postNumb = $row['postNumb'];
        $name = $row['name'];
        $options = $row['options'];
        $subject = $row['subject'];
        $image = $row['image'];
        $comment = $row['comment'];
        
        
        echo "
        
            <div id='thumbnail'>
                <a href='{$page}?thread={$postNumb}'>
                <img src='../images/{$image}' class='thumbnailImg'></a>
                <b>{$subject}</b>
                <p>{$comment}</p>
                
                <div id='sticky'>
                <a href='$page?delete=$postNumb'>DELETE</a>
                </div>
                <div id='delete'>
                <a href='$page?sticky=$postNumb'>STICKY</a>
                </div>
                <div id='ban'>
                <a href='$page?ban=$postNumb'>BAN</a>
                </div>
                </div>
            ";
        
        
        
        
    }
    
    if(isset($_GET['delete'])){
        $postNumb = $_GET['delete'];
        $query = "DELETE FROM $postsTable WHERE postNumb = $postNumb";
        $result = mysqli_query($connection,$query);
        echo "post deleted";
    }
    if(isset($_GET['sticky'])){
        $postNumb = $_GET['sticky'];
        $query = "UPDATE $postsTable SET type = 'sticky' WHERE postNumb = $postNumb";
        $result = mysqli_query($connection,$query);
        echo "post stickied";
    }
    if(isset($_GET['ban'])){
        
        
    }
    
?>
</head>
</html>