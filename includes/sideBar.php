<div class="col-md-4">

    <?php //echo $_POST["search"] 
        include "includes/db.php";
        // global $result_1;
        // if (assert($_POST["submit"])){
        //     $search =  $_POST["search"];
        //     $query_select_tag = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
        //     $result_1 = mysqli_query($conn, $query_select_tag);
        //     if (!$result){
        //         die("Error no tags selected from the DB".mysqli_error($conn));
        //     }
        //    if (mysqli_num_rows($result_1) == 0 ){
        //     echo "<h2>No Result Found</h2>";
        //    }

        // }

        
    ?>

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                <div class="well">
                    <h4>LOGIN</h4>
                    <form action="includes/login.php" method="POST">
                        <div class="form-group">
                            <label for="username_login">Username</label>
                            <input name="username_login" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_login">Password</label>
                            <input name="password_login" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <span class="input-group-btn">
                                <button name="login" type="submit" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-log-in"></span> Log in
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php 
                            $qeury = "SELECT * FROM categories;";
                            $result2 = mysqli_query($conn, $qeury);
                            if (!$result2){
                                die("Error: categories not selected");
                            }
                            while ($row = mysqli_fetch_assoc($result2)){
                                $cat = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                //$link="<a href='#'>$cat</a>";
                                echo "<li>";
                                echo "<a href='category.php?category=$cat_id'>{$cat}</a>";
                                echo "</li>";
                    
                                
                            }?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <!-- <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
              <?php include "includes/widget.php" ?>

            </div>
