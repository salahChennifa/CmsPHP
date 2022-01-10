<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post ID</th>
            <th>Comment Author </th>
            <th>Comment Email </th>
            <th>Comment Context</th>
            <th>Comment Status</th>
            <th>In Response to</th>
            <th>Comment Date</th>
            <th>Approve</th>
            <th>Unpprove</th>
            
        </tr>
    </thead>
    <tbody>
    <?php
    if (isset($_GET['id_comment'])){
        $comment_id = $_GET['id_comment'];
        $qeury_test_delet_comment = "DELETE FROM comments WHERE comment_id = $comment_id ";
        $result_test_delet_comment = mysqli_query($conn, $qeury_test_delet_comment);
        if (!$result_test_delet_comment){
            die ("Error : " . mysqli_error($conn));
        }
        //header("Location : admin/posts.php");
        header("Refresh:0; url=comments.php");
    }
    
    $qeury_select_allComments = "SELECT * FROM comments";
    $result_select_allComments = mysqli_query($conn, $qeury_select_allComments);
    if (!$result_select_allComments){
        die("Error : ".  mysqli_error($conn));
    }

    while($row = mysqli_fetch_assoc($result_select_allComments)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        

        echo "<tr>";
            echo "<td>";
                echo "{$comment_id}";
            echo "</td>";
            echo "<td>";
                //$qeury_test = "SELECT cat_title  FROM categories WHERE cat_id =  $post_category_id";
                echo "{$comment_post_id}";
            echo "</td>";
            echo "<td>";
                echo "{$comment_author}";
            echo "</td>";
            echo "<td>";
                echo "{$comment_email}";
            echo "</td>";
            echo "<td>";
                echo "{$comment_content}";
            echo "</td>";
            echo "<td>";
                echo "{$comment_status}";
            echo "</td>";
            echo "<td>";
                $qeury_test = "SELECT *  FROM posts WHERE post_id =  $comment_post_id";
                $restult_qeury_test = mysqli_query($conn, $qeury_test);
                if (!$restult_qeury_test){
                    die("Error : " . mysqli_error($conn));
                }
                while ($row = mysqli_fetch_assoc($restult_qeury_test)){
                    
                    $title_post = $row['post_title'];
                    $post_id = $row['post_id'];
                    
                }
                
                echo "<a href='../post.php?p_id=$post_id'>{$title_post}</a>";
            echo "</td>";
            echo "<td>";
                echo "{$comment_date}";
            echo "</td>";
            echo "<td>";
                echo "<a href='comments.php?approved={$comment_id}'>Approve</a>";
            echo "</td>";
            echo "<td>";
                echo "<a href='comments.php?unapproved={$comment_id}'>Unapprove</a>";
            echo "</td>";
            echo "<td>";
                echo "<a href='comments.php?id_comment={$comment_id}'>Delete</a>";
            echo "</td>";
        echo "</tr>";

        if (isset($_GET['unapproved'])){
            $id_comment =  $_GET['unapproved'];
            //echo '-------'.$id_comment;
            
            $qeury_update = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $id_comment ";

            $result_update = mysqli_query($conn, $qeury_update);
            if (!$result_update){
                die ( "Error " . mysqli_error($conn));
            }
            header("Refresh:0; url=comments.php");
        }
        if (isset($_GET['approved'])){
            $id_comment =  $_GET['approved'];
            //echo '-------'.$id_comment;
            
            $qeury_update = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $id_comment ";

            $result_update = mysqli_query($conn, $qeury_update);
            if (!$result_update){
                die ( "Error " . mysqli_error($conn));
            }
            header("Refresh:0; url=comments.php");
        }
    }
    
    ?>
    
    </tbody>
</table>