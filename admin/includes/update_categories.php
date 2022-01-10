<form action="categories.php?edit=<?php echo $cat_id?>" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Edit Cagegory </label>  
                                    <?php
                                           if (isset($_GET['edit'])){
                                            $qeury_select = "SELECT * FROM categories WHERE cat_id = $cat_id;";
                                            $result_select = mysqli_query($conn, $qeury_select);
                                            if (!$result_select){
                                                die("Error: categories not selected");
                                            }
                                            while ($row = mysqli_fetch_assoc($result_select)){  
                                                $cat_title = $row['cat_title'];
                                                // $cat_id_ = $row['cat_id'];?>
                                                 <input value="<?php if (isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title_">
                                            <?php   } }?>


                                      


                                    <?php
                                       
                                        if (isset($_POST["update_category"])){
                                            
                                            $title_cat = $_POST["cat_title_"];
                                            $qeury_update_cat = "UPDATE categories set cat_title = '$title_cat' WHERE cat_id = {$cat_id}";
                                            $result_delet_qeury = mysqli_query($conn, $qeury_update_cat);
                                            if (!$result_delet_qeury){
                                                die("Error : ".  mysqli_error($conn));
                                            }
                                            header("Location: categories.php");
                                           
                                        }
                                        
                                    
                                    ?>

                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
</form>