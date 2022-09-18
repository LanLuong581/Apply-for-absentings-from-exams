<?php
session_start();
    // session_destroy();
    if(isset($_SESSION['acc_student_id'])&& !empty($_SESSION['acc_student_id'])){
        unset($_SESSION['acc_student_id']);
        header("location:./login.php");
    } 
?>