<?php
include('../Config/constants.php');
session_start();
if (!isset($_SESSION['acc_account_type'])) {
    header("location:../templates/login.php");
}

// $application_id = $_GET['application_id'];
$student_id = $_GET['student_id'];
$sql_account = "DELETE FROM `account` WHERE student_id='$student_id'";
$sql_student = "DELETE FROM `application` WHERE student_id='$student_id'";
$sql_application = "DELETE FROM `students` WHERE student_id='$student_id'";
if (mysqli_query($conn, $sql_application)) {
    if (mysqli_query($conn, $sql_account) && mysqli_query($conn, $sql_student)) {
        echo "<script>alert('xóa sinh viên thành công')</script>";
        header('location:sinhvien.php?a=1');
    } else {
        echo "lỗi xóa bảng accoutn và students: " . mysqli_error($conn);
    }
} else {
    echo "lỗi xóa bảng application: " . mysqli_error($conn);
}
