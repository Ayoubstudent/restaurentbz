<?php    
include('../config/constants.php');
$id = $_GET['id'];
$sql = "DELETE FROM tbl_categorys WHERE id=$id";
$res = mysqli_query($conn, $sql);


if($res==TRUE){

    $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";

    header('location:'.SITEURL.'admin/manage-category.php');

}
else{

    $_SESSION['delete'] = "<div class='error'>category Admin Deleted , try again later</div>";

    header('location:'.SITEURL.'admin/manage-category.php');
}



?>