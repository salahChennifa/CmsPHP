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

include "includes/db.php";
global $result_1;
if (assert($_POST["submit"])){
    $search =  $_POST["search"];
    $query_select_tag = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    $result_1 = mysqli_query($conn, $query_select_tag);
    if (!$result){
        die("Error no tags selected from the DB".mysqli_error($conn));
    }
   if (mysqli_num_rows($result_1) == 0 ){
    echo "<h2>No Result Found</h2>";
   }

   else{

      while ($row = mysqli_fetch_assoc($result_1)){
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
      <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

      <hr>
  <?php
  }
 
   }

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