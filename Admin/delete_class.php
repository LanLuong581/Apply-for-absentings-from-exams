<?php
   include('../Config/constants.php');
   session_start();
   if (!isset($_SESSION['acc_account_type'])) {
       header("location:../templates/login.php");
   }
 
    $class_id=$_GET['class_id'];
    $sql="DELETE FROM `class` WHERE class_id='$class_id'";
    if(mysqli_query($conn,$sql))
    {
        // echo "<script>alert('xóa đơn thành công')</script>"; 
        header('location:lophoc.php?a=1');

    }
    else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

?>