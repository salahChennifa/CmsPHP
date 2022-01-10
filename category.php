<?php include "includes/header.php" ?>
<?php include "includes/db.php";
  
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
                if (isset($_GET['category'])){
                    $id_category = $_GET['category'];
                }

              $query_select = "SELECT * FROM posts WHERE post_category_id = $id_category";
              $result = mysqli_query($conn, $query_select);
              if(!$result){
                  die("Erro: problem to select From posts table");
              }
                while ($row = mysqli_fetch_assoc($result)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date  = $row['post_date'];
                    $post_image = $row['post_image'];
                    //$post_content  = $row['post_content'];
                    $post_status = substr($row['post_status'], 100);
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
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                
                <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive"  src="images/<?php echo $post_image?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php
            }
            ?>
                

            

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