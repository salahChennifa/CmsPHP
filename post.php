<?php include "includes/header.php" ?>
<?php include "includes/db.php";
session_start();

    if (isset($_POST['create_comment'])){
       
        $comment_author = $_POST["comment_author"];
        $comment_email = $_POST["comment_email"];
        $comment_content = $_POST["comment_content"];
        $id_post = $_GET['p_id'];
        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
            $query_insert = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,  comment_date ) ";
            $query_insert .= " VALUES ( $id_post, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
            $result_insert = mysqli_query($conn, $query_insert);
            if (!$result_insert){
                die("Error" . mysqli_error($conn));
            }

            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
            $query .= " WHERE post_id = $id_post ";
            $result_query = mysqli_query($conn, $query);
            if (!$result_query){
                die("Error" . mysqli_error($conn));
            }
             
        }else{
            echo "<script> alert('Fields cannot be mempty') </script>";
        }
        // $comment_author = $_POST["comment_author"];
        // $comment_author = $_POST["comment_author"];
        

        //header("Refresh:0; url=posts.php");
    }

    // TODO : !! here let create a query to update the field count for each add post
   
  
?>

<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php 
                if (isset($_GET['p_id'])){
                    $id_post = $_GET['p_id'];
                    //echo "---".$id_post;
                
              $query_select = "SELECT * FROM posts WHERE post_id = $id_post";
              $result = mysqli_query($conn, $query_select);
              if(!$result){
                  die("Erro: problem to select From posts table");
              }
                while ($row = mysqli_fetch_assoc($result)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date  = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content  = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    
                    $post_comment_count  = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                    ?>
                    
                


                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

               

                <!-- First Blog Post -->
                <h2>
                    
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>
            <?php
            }}
            ?>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                //echo "--id : " .$id_post;
                $query_select_all = "SELECT * FROM comments WHERE comment_post_id = {$id_post} ";
                $query_select_all .= " AND comment_status = 'approved' ORDER BY comment_id DESC";

                $result_select_all = mysqli_query($conn, $query_select_all);
                if (!$result_select_all){
                    die("Error : " . mysqli_error($conn));
                }

                while ($row = mysqli_fetch_array($result_select_all)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];

                
                
                
                ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author; ?>
                            <small><?php echo $comment_date?></small>
                        </h4>
                         <?php echo $comment_content ?>
                    </div>
                </div>

            
            <?php } ?>

            <hr>




             

            

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sideBar.php' ?>

        </div>
  
        <!-- /.row -->

        <hr>

        

<?php include 'includes/footer.php' ?>