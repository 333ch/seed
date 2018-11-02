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
                <img src='images/{$image}' class='thumbnailImg'>
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
        <a href='{$page}?thread={$postNumb}'>
            <div id='thumbnail'>
                <img src='images/{$image}' class='thumbnailImg'>
                <b>{$subject}</b>
                <p>{$comment}</p>
            </div>
        </a>
            ";
        
    }
?>