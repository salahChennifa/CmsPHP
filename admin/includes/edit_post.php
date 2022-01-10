

<?php 
 if (isset($_GET['source'])){
    $id_post_to_edit = $_GET['id_post_edit'];
    
    $qeury_post_to_edit = "SELECT * FROM posts WHERE post_id = $id_post_to_edit;";
    $result_post_to_edit = mysqli_query($conn, $qeury_post_to_edit);
    if (!$result_post_to_edit){
        die("Error: categories not selected");
    }
    while ($row = mysqli_fetch_assoc($result_post_to_edit)){  
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image_ = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];

        // $cat_id_ = $row['cat_id'];
    ?>

    
<form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Post Title </label>  
            <input value="<?php if (isset($post_title)){echo $post_title;} ?>" type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
            <select name="post_category" id="post_category">
                <?php 
                    $qeury_select_all = "SELECT * FROM categories";
                    $result_select_all = mysqli_query($conn, $qeury_select_all);
                    if (!$result_select_all){
                        die("Error : " . mysqli_error($conn));
                    }
                    while ($row = mysqli_fetch_assoc($result_select_all)){
                        $cat_id_all = $row['cat_id'];
                        $cat_title_all = $row['cat_title'];
                        ?>
                        <option value="<?php echo $cat_id_all?>"><?php echo $cat_title_all; ?></option>

                    <?php }?>
                
                
            </select>
        </div>

        <div class="form-group">
            <label for="author">Post Author </label>  
            <input value="<?php if (isset($post_author)){echo $post_author;} ?>" type="text" class="form-control" name="author">
        </div>

      

        <div class="form-group">
        <label for="post_status">Post Status </label>  
        <!-- <input type="text" class="form-control" name="post_status"> -->
        <select name="post_status" id="post_status">
            <?php
                
                if ($post_status === 'draft'){
            ?>
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <option value="published">published</option>
            <?php 
                }else{
            ?>
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <option value="draft">draft</option>
            <?php 
            }?>
            
        </select>
    </div>


        <div class="form-group">
        
            <label for="image">Post Image </label>  
            <img  width="100" src="../images/<?php echo $post_image_; ?>" type="file"  name="image">
            <input type="file"  name="image">
        </div>
        

        <div class="form-group">
          <label for="post_tags">Post Tags </label>  
            <input value="<?php if (isset($post_tags)){echo $post_tags;} ?>" type="text" class="form-control" name="post_tags">
        </div>

        <div class="form-group">
        <!--   -->
            <label for="post_content">Post Content </label>  
            <textarea   class="form-control" name="post_content" cols="30" rows="10" id=""><?php if (isset($post_content)){echo $post_content;} ?> </textarea>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_post" value="Update Post">
        </div>
</form>




<?php   } }?>


<?php 
 if (isset($_POST['edit_post'])){
     
    


    $title_ = mysqli_escape_string($conn,$_POST['title']);
    $author_ = $_POST['author'];
    $post_category_id_ = $_POST['post_category'];
    $post_status_ = $_POST['post_status'];
    //$image = $_POST['image'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags_ = $_POST['post_tags'];
    $post_content_ = $_POST['post_content'];
    $post_date_ = date("d-m-y");
    $post_comment_count_ = 4;
    move_uploaded_file($post_image_temp,"../images/".$post_image);
    if (empty($post_image)){
        //$id_post_to_edit
        $qeury = "SELECT post_image FROM posts WHERE post_id = $id_post_to_edit ";
        $result_ = mysqli_query($conn, $qeury);
        if (!$result_){
            die("Error : ". mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result_post_to_edit)){
            $post_image = $row['post_image']; 
        }
    }

    $qeury_update_cat = "UPDATE posts set post_title = '$title_', ";
    $qeury_update_cat .= " post_author = '$author_', ";
    $qeury_update_cat .= " post_category_id = '$post_category_id_', ";
    $qeury_update_cat .= "post_status  = '$post_status_', " ;
    $qeury_update_cat .= " post_image  = '$post_image', ";
    $qeury_update_cat .= "post_tags  = '$post_tags_', ";
    $qeury_update_cat .= "post_content  = '$post_content_' , ";
    $qeury_update_cat .= "post_date  = now(), ";
    $qeury_update_cat .= "post_comment_count  = '$post_comment_count_' ";
    $qeury_update_cat .=  " WHERE post_id = {$id_post_to_edit}";
    $update_post = mysqli_query($conn, $qeury_update_cat);
    if (!$update_post){
        die("Error : ". mysqli_error($conn));
    }
   //header("Refresh:0; url=posts.php");
   echo "<p class='bg-success'> Post Updated . <a href='../post.php?p_id={$id_post_to_edit}'>View Post</a></p>";
 }
?>





