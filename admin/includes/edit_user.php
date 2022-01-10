

<?php 
 if (isset($_GET['source'])){
    $id_user_edit = $_GET['id_user_edit'];
    
    $qeury_post_to_edit = "SELECT * FROM users WHERE user_id = $id_user_edit;";
    $result_post_to_edit = mysqli_query($conn, $qeury_post_to_edit);
    if (!$result_post_to_edit){
        die("Error: categories not selected");
    }
    while ($row = mysqli_fetch_assoc($result_post_to_edit)){  
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['user_password'];
        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        
        $post_image = $row['user_image'];
        // $post_image = $_FILES['image']['name'];
        //$post_image_temp = $_FILES['image']['tmp_name'];


        $email = $row['user_email'];
        $role = $row['user_role'];
        $randSalt = $row['randSalt'];
         
        //$post_comment_count = 4;
        //move_uploaded_file($post_image_temp,"../images/".$post_image);

        // $cat_id_ = $row['cat_id'];
    ?>

    
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="cat_title">Username </label>  
        <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
    </div>

    <div class="form-group">
        <label for="cat_title">Password </label>  
        <input type="text" class="form-control" name="password" value="<?php echo $password ?>">
    </div>

   

    <div class="form-group">
        <label for="cat_title">First Name </label>  
        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>">
    </div>

    <div class="form-group">
        <label for="cat_title">Lastname </label>  
        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>">
    </div>

    <div class="form-group">
        <label for="cat_title">Email </label>  
        <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
    </div>

    <div class="form-group">
        <label for="cat_title">Image </label> 
        <input type="file"  name="image">
        <!-- <input type="text"  name="image" value="">  -->
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
        <label for="cat_title"> User Role </label>  
        <!-- <input type="text" class="form-control" name="role" value="// echo $role "> -->
        
        <select name="role" id="role">
        <?php if ($role === "admin") {?>
            <option value="<?php echo $role?>"> <?php echo $role?></option>
            <option value="subsciber"> subsciber</option> 
        <?php } else{?>
            <option value="<?php echo $role?>"> <?php echo $role?></option>
            <option value="admin">admin</option>

        <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="cat_title">RandSalt </label>  
        <textarea  class="form-control" name="randSalt" cols="30" rows="10" id=""> <?php echo $randSalt ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user_" value="Update User">
    </div>
</form>




<?php   } }?>


<?php 
 if (isset($_POST['edit_user_'])){
    
    $id_user_edit = $_GET['id_user_edit'];

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
    // if (empty($post_image)){
    //     //$id_post_to_edit
    //     $qeury = "SELECT post_image FROM posts WHERE post_id = $id_post_to_edit ";
    //     $result_ = mysqli_query($conn, $qeury);
    //     if (!$result_){
    //         die("Error : ". mysqli_error($conn));
    //     }
    //     while ($row = mysqli_fetch_assoc($result_post_to_edit)){
    //         $post_image = $row['post_image']; 
    //     }
    // }

    $qeury_update_user = "UPDATE users set username = '$username', ";
    $qeury_update_user .= " user_password = '$password', ";
    $qeury_update_user .= " user_firstname = '$firstname', ";
    $qeury_update_user .= " user_lastname  = '$lastname', " ;
    $qeury_update_user .= " user_email  = '$email', ";
    $qeury_update_user .= "user_image  = '$image', ";
    $qeury_update_user .= "user_role  = '$role' , ";
    $qeury_update_user .= "randSalt  = '$randSalt' ";
    $qeury_update_user .=  " WHERE user_id = {$id_user_edit}";
    $update_post = mysqli_query($conn, $qeury_update_user);
    if (!$update_post){
        die("Error : ". mysqli_error($conn));
    }
   header("Refresh:0; url=users.php");
 }
?>



