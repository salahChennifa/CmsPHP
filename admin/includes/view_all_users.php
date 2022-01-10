<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>username</th>
            <th>user password </th>
            <th> First Name </th>
            <th>Last Name</th>
            <th>email</th>
            <th>image</th>
            <th>user role</th>
            <th>randSalt</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (isset($_GET['id_user'])){
       $user_id = $_GET['id_user'];
        $qeury_test_delet_user = "DELETE FROM users WHERE user_id = $user_id ";
        $result_test_delet_user = mysqli_query($conn, $qeury_test_delet_user);
        if (!$result_test_delet_user){
            die ("Error : " . mysqli_error($conn));
        }
    //     //header("Location : admin/posts.php");
        header("Refresh:0; url=users.php");
    }
    
    $qeury_select_allUsers = "SELECT * FROM users";
    $result_select_allUsers = mysqli_query($conn, $qeury_select_allUsers);
    if (!$result_select_allUsers){
        die("Error : ".  mysqli_error($conn));
    }

    while($row = mysqli_fetch_assoc($result_select_allUsers)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];

        $user_lastname = $row['user_lastname'];
        $user_firstname = $row['user_firstname'];
        $user_email = $row['user_email'];

        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $randSalt = $row['randSalt'];
        

        echo "<tr>";
            echo "<td>";
                echo "{$user_id}";
            echo "</td>";
            echo "<td>";
                //$qeury_test = "SELECT cat_title  FROM categories WHERE cat_id =  $post_category_id";
                echo "{$username}";
            echo "</td>";
            echo "<td>";
                echo "{$user_password}";
            echo "</td>";
            echo "<td>";
                echo "{$user_firstname}";
            echo "</td>";
            echo "<td>";
                echo "{$user_lastname}";
            echo "</td>";
            echo "<td>";
                echo "{$user_email}";
            echo "</td>";
            echo "<td>";
                echo "{$user_image}";
            echo "</td>";
            echo "<td>";
                echo "{$user_role}";
            echo "</td>";
            echo "<td>";
                echo "{$randSalt}";
            echo "</td>";
            echo "<td>";
                echo "<a href='users.php?id_user={$user_id}'>Delete</a>";
            echo "</td>";
            echo "<td>";
                echo "<a href='users.php?source=edit_user&id_user_edit={$user_id}'>Edit</a>";
            echo "</td>";
            echo "<td>";
                echo "<a href='users.php?admin={$user_id}'>Admin</a>";
            echo "</td>";
            echo "<td>";
                echo "<a href='users.php?sub={$user_id}'>Subscriber</a>";
            echo "</td>";
        echo "</tr>";

        if (isset($_GET['admin'])){
            $id_user =  $_GET['admin'];
            //echo '-------'.$id_comment;
            
            $qeury_update = "UPDATE users SET user_role = 'admin' WHERE user_id = $id_user ";

            $result_update = mysqli_query($conn, $qeury_update);
            if (!$result_update){
                die ( "Error " . mysqli_error($conn));
            }
            header("Refresh:0; url=users.php");
        }
        if (isset($_GET['sub'])){
            $id_user =  $_GET['sub'];
            //echo '-------'.$id_comment;
            
            $qeury_update = "UPDATE users SET user_role = 'subsciber' WHERE user_id = $id_user ";

            $result_update = mysqli_query($conn, $qeury_update);
            if (!$result_update){
                die ( "Error " . mysqli_error($conn));
            }
            header("Refresh:0; url=users.php");
        }
    }
    
    ?>
    
    </tbody>
</table>