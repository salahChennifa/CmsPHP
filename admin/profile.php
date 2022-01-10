

<?php include "includes/admin_header.php"?>
<?php include "functions.php";
if (isset($_SESSION['username'])){
    $username  =  $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $result = mysqli_query($conn, $query);
    if (!$result){
        die ("Error : " . mysqli_error($conn));
    }
    while($row = mysqli_fetch_assoc($result)){
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
    }
}
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
                            <small>author</small>
                        </h1>

    
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
        <input class="btn btn-primary" type="submit" name="edit_profile_" value="Update Profile">
    </div>
</form>

       <?php 
        if (isset($_POST['edit_profile_'])){
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
                $qeury_update_user .=  " WHERE user_id = {$user_id}";
                $update_post = mysqli_query($conn, $qeury_update_user);
                if (!$update_post){
                    die("Error : ". mysqli_error($conn));
                }
                header("Refresh:0; url=profile.php");
        }
       
       ?>               
                     
                       
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>