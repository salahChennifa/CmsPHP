<?php 
    include 'includes/db.php';
    
    if (isset($_POST['add_user_'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        
        //$image = $_POST['image'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];


        $email = $_POST['email'];
        $role = $_POST['role'];
        $randSalt = $_POST['randSalt'];
         
        //$post_comment_count = 4;
        move_uploaded_file($post_image_temp,"../images/".$post_image);

        $query_insert_user = "INSERT INTO users(username,user_password, user_firstname, user_lastname, user_email, user_image, user_role, randSalt)  ";
        $query_insert_user.=" VALUES('{$username}','{$password}','{$firstname}','{$lastname}', '{$email}', '{$post_image}', '{$role}','{$randSalt}' )";

        $resutl_insert_user = mysqli_query($conn, $query_insert_user );
        if (!$resutl_insert_user){
                    die("Query Failed . " .mysqli_error($conn));
        }
        //header("Location : ../posts.php");
        //header("Location: ../posts.php");
        //header("Location : admin/posts.php");
        header("Refresh:0; url=users.php");
    }

    
    
?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="cat_title">Username </label>  
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="cat_title">Password </label>  
        <input type="text" class="form-control" name="password">
    </div>

    <!-- <div class="form-group">
            <select name="post_category_id" id="post_category">
                <?php 
                    // $qeury_select_all = "SELECT * FROM categories";
                    // $result_select_all = mysqli_query($conn, $qeury_select_all);
                    // if (!$result_select_all){
                    //     die("Error : " . mysqli_error($conn));
                    // }
                    // while ($row = mysqli_fetch_assoc($result_select_all)){
                    //     $cat_id_all = $row['cat_id'];
                    //     $cat_title_all = $row['cat_title'];
                        ?>
                        <option value="<?php //echo $cat_id_all?>"><?php //echo $cat_title_all; ?></option>

                    <?php //}?>
            </select>
    </div> -->

    <div class="form-group">
        <label for="cat_title">First Name </label>  
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <label for="cat_title">Lastname </label>  
        <input type="text" class="form-control" name="lastname">
    </div>

    <div class="form-group">
        <label for="cat_title">Email </label>  
        <input type="text" class="form-control" name="email">
    </div>

    <div class="form-group">
        <label for="cat_title">Image </label>  
        <input type="file"  name="image">
    </div>

    <div class="form-group">
        <label for="cat_title"> User Role </label>  
        <!-- <input type="text" class="form-control" name="role" value="// echo $role "> -->
        <select name="role" id="role">
            <option value="admin"> admin</option>
            <option value="subsciber">subsciber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="cat_title">RandSalt </label>  
        <textarea  class="form-control" name="randSalt" cols="30" rows="10" id=""> </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user_" value="Add User">
    </div>
</form>





