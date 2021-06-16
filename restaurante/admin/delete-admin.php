<?php    
include('../config/constants.php');
$id = $_GET['id'];
$sql = "DELETE FROM tbl_admine WHERE id=$id";
$res = mysqli_query($conn, $sql);


if($res==TRUE){

    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

    header('location:'.SITEURL.'admin/manage-admin.php');

}
else{

    $_SESSION['delete'] = "<div class='error'>Failded Admin Deleted , try again later</div>";

    header('location:'.SITEURL.'admin/manage-admin.php');
}



?>