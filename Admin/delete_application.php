<?php
   include('../Config/constants.php');
   session_start();
   if (!isset($_SESSION['acc_account_type'])) {
       header("location:../templates/login.php");
   }
 
    $application_id=$_GET['application_id'];
    $sql="DELETE FROM `application` WHERE application_id='$application_id'";
    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('xóa đơn thành công')</script>"; 
        header('location:quanlydon_admin.php?a=1');

    }
    else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

?>