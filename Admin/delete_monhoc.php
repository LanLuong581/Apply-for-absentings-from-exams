<?php
   include('../Config/constants.php');
   session_start();
   if (!isset($_SESSION['acc_account_type'])) {
       header("location:../templates/login.php");
   }
 
    $subject_id=$_GET['subject_id'];
    $sql="DELETE FROM `subject` WHERE `subject_id`='$subject_id'";
    if(mysqli_query($conn,$sql))
    {
        // echo"<script>alert('xóa đơn thành công')</script>"; 
        header('location:lophoc.php?b=1');

    }
    else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

?>
