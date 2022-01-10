<?php 
    include 'includes/db.php';
    
    if (isset($_POST['create_post'])){
        $title = $_POST['title'];
        $author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        
        //$image = $_POST['image'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];


        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date("d-m-y");
        // TODO :: here let remove the comment count : 
        //$post_comment_count = 4;
        move_uploaded_file($post_image_temp,"../images/".$post_image);

        $query_insert_post = "INSERT INTO posts(post_category_id,post_title, post_author, post_date, post_image, post_content, post_tags, post_status)  ";
        $query_insert_post.=" VALUES('{$post_category_id}','{$title}','{$author}',now(),'{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";

        $resutl_insert_post = mysqli_query($conn, $query_insert_post );
        if (!$resutl_insert_post){
                    die("Query Failed . " .mysqli_error($conn));
        }
        //header("Location : ../posts.php");
        //header("Location: ../posts.php");
        //header("Location : admin/posts.php");
        echo "<p class='bg-success'> Post Updated . <a href='post.php'>View all Post</a></p>";
        //header("Refresh:0; url=posts.php");
    }

    
    
?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="cat_title">Post Title </label>  
        <input type="text" class="form-control" name="title">
    </div>

    <!-- <div class="form-group">
        <label for="cat_title">Post Category Id </label>  
        <input type="text" class="form-control" name="post_category_id">
    </div> -->

    <div class="form-group">
            <select name="post_category_id" id="post_category">
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
        <label for="cat_title">Post Author </label>  
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status </label>  
        <!-- <input type="text" class="form-control" name="post_status"> -->
        <select name="post_status" id="post_status">
            <option value="draft">draft</option>
            <option value="published">published</option>
        </select>
    </div>


    <div class="form-group">
        <label for="cat_title">Post Image </label>  
        <input type="file"  name="image">
    </div>

    <div class="form-group">
        <label for="cat_title">Post Tags </label>  
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
           
        <label for="cat_title">Post Content </label>  
        <textarea  class="form-control" name="post_content" cols="30" rows="10" id="body"> </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>

<script>
   
    ClassicEditor
                        .create( document.querySelector( '#body' ) )
                        .then( editor => {
                                console.log( editor );
                        } )
                        .catch( error => {
                                console.error( error );
                        } );



    // REST OF THE CODE
</script>





