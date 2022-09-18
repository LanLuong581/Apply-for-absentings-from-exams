<?php
   include('../Config/constants.php');
   session_start();
   if (!isset($_SESSION['acc_account_type'])) {
       header("location:../templates/login.php");
   }
//  bo mon duyet bang cach cap nhat bm_status =1
    $application_id=$_GET['application_id'];
    $sql="UPDATE `application` SET `tk_status`='1' WHERE application_id='$application_id'";
    $sql_diem="INSERT INTO `diem`(`diem_name`, `application_id`, `semester_id`, `year_id`)
     VALUES ('I','$application_id','5','4')";
    if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql_diem))
    {
        // echo"<script>alert('xóa đơn thành công')</script>"; 
        header('location:quanlydon_truongkhoa.php?m=1');

    }
    else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

?>