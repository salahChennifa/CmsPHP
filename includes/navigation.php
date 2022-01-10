<?php include "db.php";
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $qeury = "SELECT * FROM categories;";
                        $result = mysqli_query($conn, $qeury);
                        if (!$result){
                            die("Error: categories not selected");
                        }
                        while ($row = mysqli_fetch_assoc($result)){
                            $cat = $row['cat_title'];
                            //$link="<a href='#'>$cat</a>";
                            echo "<li>";
                            echo "<a href='#'>{$cat}</a>";
                            echo "</li>";
                        }
                    
                    ?>
                    <li>
                        <a href="admin">admin</a>
                    </li>
                    <?php
                        if (isset($_SESSION['lastname'])){
                          
                            if (isset($_GET['p_id'])){
                              
                                $post_id = $_GET['p_id'];
                               
    
                                echo
                                "<li>
                                    <a href='admin/posts.php?source=edit_post&id_post_edit={$post_id}'>Edit Post</a>
                                </li>";
                            }
                          
                            
                        }
                       
                    
                    ?>
                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        

        <!-- /.container -->
    </nav>