<?php  include('patials-front/menu.php');   ?>


<?php

if(isset($_GET['categorys_id'])){

    $categorys_id = $_GET['categorys_id'];

    $sql = "SELECT title FROM tbl_categorys WHERE id=$categorys_id";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);

    $categorys_title = $row['title'];
}
else {

    header('location:'.SITEURL);
}



?>
    <!-- fOOD sEARCH Section Ends Here -->

    <section class="food-search text-center">
        <div class="container"> 

            <h2>Food On <a href="#" class="text-white">"<?php echo $categorys_title; ?>"</h2>
          
        </div>
   </section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

               <?php

                  $sql2 = "SELECT * FROM tbl_food WHERE categorys_id=$categorys_id";

                  $res2 = mysqli_query($conn, $sql2);

                  $count2 = mysqli_num_rows($res2);

                  if($count2>0){
                    
                    while($row2 = mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        
                        ?>
                             

                             <div class="food-menu-box">
                                  <div class="food-menu-img">
                                      <?php
                                       
                                       if($image_name==""){
                                          
                                       echo "<div class='error'>Image Not Availabel</div>";

                                       }
                                       else{
                                            ?>
                                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php

                                       }


                                       ?>
                                    
                                     </div>

                                        <div class="food-menu-desc">
                                             <h4><?php echo $title; ?> </h4>
                                             <p class="food-price">$<?php echo $price; ?></p>
                                                 <p class="food-detail">
                                                        <?php echo $description; ?>
                                                 </p>
                                                                  <br>

                                                               <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                          </div>
                                 </div>
                        <?php

                    }


                  }
                  else {

                   echo  "<div class='error'>Food Not availabel</div>";

                  }



              ?>

           

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php  include('patials-front/footer.php');   ?>