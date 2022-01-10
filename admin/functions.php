<?php 

// function confirm($result, $conn){
//     if (!$result){
//         die("Query Failed . " .mysqli_error($conn));
//     }
//     //return $result;
// }

function insert_categories(){
    //include "includes/db.php";
    global $conn;
    if (isset($_POST['submit'])){
                            $cat_title_1 = $_POST['cat_title'];
                            if ($cat_title_1 == "" || empty($cat_title_1)){
                                echo "This filed should not be empty";
                            }else{
                                $qeury = "INSERT INTO categories(cat_title) VALUE('{$cat_title_1}')";
                                $result = mysqli_query($conn, $qeury);
                                if (!$result){
                                    die("Error".mysqli_error($conn));
                                }
                            }
                        }
}

function findAllCategoriesAndDelete(){
    global $conn;
    if (isset($_GET["delete"])){
        $id_cat_delete = $_GET["delete"];
        $qeury_delet_cat = "DELETE FROM categories WHERE cat_id = {$id_cat_delete}";
        $result_delet_qeury = mysqli_query($conn, $qeury_delet_cat);
        if (!$result_delet_qeury){
            die("Error : ".  mysqli_error($conn));
        }
        header("Location: categories.php");
    }
    $qeury = "SELECT * FROM categories;";
    $result2 = mysqli_query($conn, $qeury);
    if (!$result2){
        die("Error: categories not selected");
    }
    while ($row = mysqli_fetch_assoc($result2)){
        $cat_title = $row['cat_title'];
        $cat_id_d = $row['cat_id'];
        echo "<tr>";
        echo "<td>";
        echo "{$cat_id_d}";
        echo "</td>";
        echo "<td>";
        echo "{$cat_title}";
        echo "</td>";
        echo "<td>";
        echo "<a href='categories.php?delete={$cat_id_d}'>Delete</a>";
        echo "</td>";
        echo "<td>";
        echo "<a href='categories.php?edit={$cat_id_d}'>Edit</a>";
        echo "</td>";
        echo "</tr>";
    }
}

?>