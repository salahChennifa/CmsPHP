<?php 
    if(isset($_POST['checkBoxArray'])){
       
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            $checkBoxValue; 
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                    
                    $query_t = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$checkBoxValue'";
                    $result_t = mysqli_query($conn, $query_t);
                    if (!$result_t){
                        die("Error : " . mysqli_error($conn));
                    }
                    
                    break;

                    case 'draft':
                        
                        $query_t = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$checkBoxValue'";
                        $result_t = mysqli_query($conn, $query_t);
                        if (!$result_t){
                            die("Error : " . mysqli_error($conn));
                        }
                        
                        break;
                    case 'delete':
                       
                        $query_t = "DELETE  FROM posts WHERE post_id = '$checkBoxValue'";
                        $result_t = mysqli_query($conn, $query_t);
                        if (!$result_t){
                            die("Error : " . mysqli_error($conn));
                        }
                        
                        break;
            }
        }
    }
?>
<form action="" method="POST">

<table class="table table-bordered table-hover">
    <div id="bulkIptionsContainer" class="col-xs-4" style="padding-left: 0px;">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div id="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>
    </div>
                            <thead>
                                <tr>
                                    <th>
                                        <input id="selectAllBoxes" type="checkbox">
                                    </th>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    <th>View Post</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $qeury_select_allPosts = "SELECT * FROM posts";
                            $result_select_allPosts = mysqli_query($conn, $qeury_select_allPosts);
                            if (!$result_select_allPosts){
                                die("Error : ".  mysqli_error($conn));
                            }

                            while($row = mysqli_fetch_assoc($result_select_allPosts)){
                                $post_id = $row['post_id'];
                                $post_author  = $row['post_author'];
                                $post_title  = $row['post_title'];
                                $post_category_id   = $row['post_category_id'];
                                $post_status = $row['post_status'];
                                $post_image  = $row['post_image'];
                                $post_tags  = $row['post_tags'];
                                $post_comment_count  = $row['post_comment_count'];
                                $post_date  = $row['post_date'];
                                
                                echo "<tr>";
                                //<input id="selectAllBoxes" type="checkbox">
                                // echo "<input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id;
                                    echo "<td>";

                                    ?>
                                        <input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id?>'>
                                    <?php
                                    echo "</td>";
                                    echo "<td>";
                                        echo "{$post_id}";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "{$post_author}";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "{$post_title}";
                                    echo "</td>";
                                    echo "<td>";
                                    $qeury_test = "SELECT cat_title  FROM categories WHERE cat_id =  $post_category_id";
                                    $result_test_ = mysqli_query($conn, $qeury_test);
                                    if (!$result_test_){
                                        die("Erro : " . mysqli_error($conn));
                                    }
                                    while ($row = mysqli_fetch_assoc($result_test_)){
                                        $cat_title_selected = $row['cat_title'];
                                    }
                                        echo "{$cat_title_selected}";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "{$post_status}";
                                    echo "</td>";
                                    echo "<td>";
                                        //echo "{$post_image}";
                                        echo "<img width='100' class='img-responsive' src='../images/$post_image' alt='$post_tags'>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "{$post_tags}";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "{$post_comment_count}";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "{$post_date}";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href='posts.php?delete_={$post_id}'>Delete</a>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href='posts.php?source=edit_post&id_post_edit={$post_id}'>Edit</a>";
                                    echo "</td>";
                                    echo "<td>";
                                        /// post.php?p_id=<?php echo $post_id 
                                        echo "<a href='../post.php?p_id={$post_id}'>show the post</a>";
                                    echo "</td>";
                                   
                                echo "</tr>";
                                                        
                            }
                            
                            ?>
                            </tbody>
                        </table>

    </form>


<?php 

            if (isset($_GET['delete_'])){
                global $conn;
                //$id_post_deleted = $_GET("delete_");
                $id_test_delete = $_GET['delete_'];
                //echo "------ : ".$_GET['delete_'];

                $qeury_test_delet_post = "DELETE FROM posts WHERE post_id = $id_test_delete ";
                $result_test_delet_post = mysqli_query($conn, $qeury_test_delet_post);
                if (!$result_test_delet_post){
                    die ("Error : " . mysqli_error($conn));
                }
                //header("Location : admin/posts.php");
                header("Refresh:0; url=posts.php");
                
                
            }
            //header("Refresh:0");

?>