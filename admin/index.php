<?php include "includes/admin_header.php";
session_start();
?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">
 
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin

                            
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM posts  WHERE post_status = 'published'";
                        $select_posts = mysqli_query($conn, $query);
                        $post_count  = mysqli_num_rows($select_posts);
                    ?>
                  <div class='huge'><?php echo $post_count?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query_cmt = "SELECT * FROM comments";
                        $select_comments = mysqli_query($conn, $query_cmt);
                        $comment_count  = mysqli_num_rows($select_comments);
                    ?>
                     <div class='huge'><?php echo $comment_count ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query_users = "SELECT * FROM users";
                        $select_users = mysqli_query($conn, $query_users);
                        $users_count  = mysqli_num_rows($select_users);
                    ?>
                    <div class='huge'><?php echo $users_count ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query_categories = "SELECT * FROM categories";
                        $select_categories = mysqli_query($conn, $query_categories);
                        $categories_count  = mysqli_num_rows($select_categories);
                    ?>
                        <div class='huge'><?php echo $categories_count ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
<div class="row">
<?php 
 $query_published_post = "SELECT * FROM posts WHERE post_status = 'published'";
 $select_published_posts = mysqli_query($conn, $query_published_post);
 $post_published_count  = mysqli_num_rows($select_published_posts);

 $query_draft_post = "SELECT * FROM posts WHERE post_status = 'draft'";
 $select_draft_posts = mysqli_query($conn, $query_draft_post);
 $post_draft_count  = mysqli_num_rows($select_draft_posts);

 $query_cmt_una = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $select_comments_una = mysqli_query($conn, $query_cmt_una);
    $comment_count_una  = mysqli_num_rows($select_comments_una);

    $query_users_subsciber = "SELECT * FROM users where user_role = 'subsciber'";
    $select_users_subsciber = mysqli_query($conn, $query_users_subsciber);
    $users_count_subsciber  = mysqli_num_rows($select_users_subsciber);

?>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            <?php 
                $element_text = ['All Posts','Active Posts','Draft Posts',  'Categories', 'Users','subsciber users', 'Comments', 'unapproved comments'];
                $element_count = [$post_count + $post_draft_count,$post_count, $post_draft_count, $categories_count, $users_count, $users_count_subsciber, $comment_count, $comment_count_una];
                for($i = 0; $i < 7; $i++ ){
                    echo "['{$element_text[$i]}'".", "." {$element_count[$i]}],";
                }

            ?>


          //['Posts', 1000],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: auto; height: 500px;"></div>


</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>