<?php include('patials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>
            <?php
              if(isset($_GET['id'])){

                $id=$_GET['id'];
              }
             ?>

        <form action="" method="POST">
             <table class="tbl-30">
        
                 <tr>
        
                    <td> Current Password:</td>
                         <td>
                           <input type="password" name="current_password" placeholder="Current Paasword">
                        </td>
        
                 </tr>
        
                       <tr>
                            <td>New Password:</td>
                                <td>
                                  <input type="password" name="new_password" placeholder="New Password">
                                
                                </td>
                             
                             
                           </tr>


                               <tr>
                                <td>Confirm Password:</td>
                                   <td>
                                      <input type="password" name="confirm_password" placeholder="Confirm Password">
                                   </td>
                               
                               </tr>
                                     <tr>
                                       <td colspan="2">
                                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                                          <input type="submit" name="submit" value="change password" class="btn-secondary">
                                       </td>
                                     
                                     
                                     </tr>
            </table>
        </form>
    </div>
</div>          
<?php 
if(isset($_POST['submit'])){
   
   $id = $_POST['id'];
   $current_password = md5($_POST['current_password']);
   $new_password = md5($_POST['new_password']);
   $confirm_password = md5($_POST['confirm_password']);
   
   $sql = "SELECT * FROM tbl_admine WHERE id=$id AND password = '$current_password'";
   
   $res = mysqli_query($conn, $sql);
   
   if($res==TRUE){

    $count = mysqli_num_rows($res);
    if($count==1){

      echo "user Found";
    }else
    $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
    header('location:'.SITEURL.'admin/manage-admin.php'); 
   }



}


?>
  <?php include('patials/footer.php');