<?php
   include('../Config/constants.php');
   session_start();
   if (!isset($_SESSION['acc_account_type'])) {
       header("location:../templates/login.php");
   }
//  giang vien tu choi don bang cach cap nhat cvgd_status = 2
    $application_id=$_GET['application_id'];
    $sql="UPDATE `application` SET `cvgd_status`='2' WHERE application_id='$application_id'";
    if(mysqli_query($conn,$sql))
    {
        // giang vien tu choi thanh cong don
        header('location:quanlydon_giangvien.php?m=1');

    }
    else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

?>