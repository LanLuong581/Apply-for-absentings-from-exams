<?php
   include('../Config/constants.php');
   session_start();
   if (!isset($_SESSION['acc_account_type'])) {
       header("location:../templates/login.php");
   }
//  bo mon duyet bang cach cap nhat bm_status =1
    $application_id=$_GET['application_id'];
    $sql="UPDATE `application` SET `bm_status`='1' WHERE application_id='$application_id'";
    if(mysqli_query($conn,$sql))
    {
        // echo"<script>alert('xóa đơn thành công')</script>"; 
        header('location:quanlydon_bomon.php?m=1');

    }
    else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

?>