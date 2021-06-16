<?php  include('patials-front/menu.php');   ?>
    <!-- Navbar Section Ends Here -->



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

              $sql = "SELECT * FROM tbl_categorys WHERE active='Yes'";
              
              $res = mysqli_query($conn, $sql);

              $count = mysqli_num_rows($res);

              if($count>0){
                  
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];


                    ?>
                         <a href="<?php echo SITEURL;?>category-foods.php?categorys_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">

                               <?php 
                               if($image_name==""){
                                     
                              
                                echo "<div class='error'>Image Not Found</div>";

                               }else {

                                
                                ?>
                                    
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;  ?>"  class="img-responsive img-curve">

                              <?php
                               }
                               
                               
                               
                               
                               
                               ?>
                                 

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                      </div>
                                         </a>

                    <?php
                }

              } else {

                 echo "<div class='error'>Category Not Found</div>";
              }

              
            ?>

          

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    <?php  include('patials-front/footer.php');   ?>