<?php include('patials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
          
       <br> <br> 
         
         <?php

           if(isset($_GET['id'])){

             $id = $_GET['id'];
              
            $sql = "SELECT * FROM tbl_food WHERE id=$id";

            $res = mysqli_query($conn, $sql);
            
            $count = mysqli_num_rows($res);

            if($count==1){
              
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_categorys = $row['categorys_id'];
                $fuatured = $row['fuatured'];
                $active = $row['active'];

            }
            else{

                $_SESSION['no-category-found'] = "<div class='error'>food Not Found.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

            }

           }
            else{
                header('location:'.SITEURL.'admin/manage-category.php');
            }


        ?>

       <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

              <tr>
                 <td>Title :</td>

                  <td>
                     <input type="text" name="title" value="<?php echo $title; ?>">
                  </td>
              </tr>

              <tr>
                 <td>Description :</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
              </tr>

              <tr>
                 <td>Price :</td>
                    <td>
                          <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
              </tr>

              <tr>
                  <td>Current Image :</td>
                  <td>
                    <?php

                      if($current_image != ""){

                        ?>
                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px";>

                        <?php

                      }
                      else{
                          echo "<div class='error'>Image Not Add.</div>";


                        }



                    ?>
                  </td>
              </tr>

              <tr>
                <td>Select Image</td>

                  <td>
                     <input type="file" name="image" >
                  </td>
              </tr>

              <tr>
                 <td>Category:</td>
                     
                   <td>
                      <select name="categorys" >

                      <?php

                         $sql = "SELECT * FROM tbl_categorys WHERE active='Yes'";
                         $res = mysqli_query($conn, $sql);
                         $count = mysqli_num_rows($res);

                         if($count>0){

                             while($row=mysqli_fetch_assoc($res)){

                                $category_title = $row['title'];
                                $category_id = $row['id'];
                               
                           //  echo "<option value='$category_id'>$category_title</option>";

                               ?>
                                   <option <?php if($current_categorys==$category_id){echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                               <?php

                             }
                         }  
                         else  {

                              echo "<option value='0'>Category Not Available</option>";
                        
                          }

                         

                         ?>
                       
                      </select>
                   </td>
              </tr>

              <tr>
                <td>Featured :</td>
                   <td>
                     <input <?php if($fuatured=="Yes"){ echo "checked";} ?> type="radio" name="fuatured" value="Yes">Yes
                     <input <?php if($fuatured=="No"){ echo "checked";} ?> type="radio" name="fuatured" value="No">No
                   </td>
              </tr>


              <tr>

                 <td>Active :</td>

                   <td>
                     <input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                     <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
                   </td>
              </tr>

              <tr>
                 <td>
                   <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                   <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                 </td>
              </tr>
        
        
            </table>

        </form>

         <?php 


          if(isset($_POST['submit'])){

            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $current_categorys = $_POST['categorys_id'];
            $fuatured = $_POST['fuatured'];
            $active = $_POST['active'];

            if(isset($_FILES['image']['name'])){

                $image_name = $_FILES['image']['name'];

                if($image_name != ""){
                     

               //      $ext = end(explode('.', $image_name));
                //$image_name = "Food_Category_".rand(000, 999).'.'.$ext;
              $source_path = $_FILES['image']['tmp_name'];
   
              $destination_path = "../images/food/".$image_name;
 
             $upload = move_uploaded_file($source_path, $destination_path);

             if($upload==false){

              $_SESSION['upload'] = "<div class='success'>Failed To Upload Image </div>";
              header('location:'.SITEURL.'admin/manage-food.php');
              die();
             }
                

              if($current_image != ""){

                $remove_path = "../images/food/".$current_image;

                $remove = unlink($remove_path);
   
                if($remove==false){
   
                   $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image</div>";
                   header('location:'.SITEURL.'admin/manage-food.php');
                   die();
                }

              }
            

                }

                else{

                    $image_name = $current_image; 
                }
            }
            else{

               $image_name = $current_image;

            }

            $sql2= "UPDATE tbl_food SET 
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            fuatured = '$fuatured',
            active = '$active'
            WHERE id=$id
            ";
            $res2 = mysqli_query($conn, $sql2);

            if($res2==true){

                 $_SESSION['update'] = "<div class='success'>Food updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                header('location:'.SITEURL.'admin/manage-food.php');


            }

          }




        ?>
    </div>
</div>

<?php include('patials/footer.php'); ?>