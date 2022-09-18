<?php
   include('../Config/constants.php');
   session_start();
   if (!isset($_SESSION['acc_account_type'])) {
       header("location:../templates/login.php");
   }
 
    $teacher_id=$_GET['teacher_id'];
    $sql="DELETE FROM teacher WHERE teacher_id='$teacher_id'";
    $sql_delete="DELETE FROM account WHERE student_id='$teacher_id'";
    if(mysqli_query($conn,$sql_delete) && mysqli_query($conn,$sql))
    {
        // echo "<script>alert('xóa đơn thành công')</script>"; 
        header('location:index_Admin.php?a=1');

    }
    else {
        echo "Error deleting record: " . mysqli_error($conn);
        }

?>