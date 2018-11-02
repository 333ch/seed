<?php include "includes/header.php" ?>

    <div id="wrapper">


        
        

        <?php include "includes/navigation.php" ?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            3chan Admin
                            
                        </h1>
                        <div>
                            <?php
                             $connection = mysqli_connect('localhost', 'root', '', 'getpost');
                             $threadsTable = "threadsb";
                             $page = "b.php";
    
                            $query = "SELECT * FROM {$threadsTable} ORDER BY ordid";
                            $select_all_threads_query = mysqli_query($connection,$query);

                                while($row = mysqli_fetch_assoc($select_all_threads_query)){
                                    $postNumber = $row['id'];
                                    $name = $row['name'];
                                    $options = $row['options'];
                                    $subject = $row['subject'];
                                    $image = $row['image'];
                                    $comment = $row['comment'];
        
                                    echo "
                                        <a href='{$page}?thread={$postNumber}'>
                                        <div id='thumbnail'>
                                        <img src='../images/{$image}' height='100' width='100'>
                                        <b>{$subject}</b>
                                        <p>{$comment}</p>
                                        </div>
                                        </a>
                                        ";
        
    }
?>





                        </div>
                    


                            
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/footer.php" ?>

