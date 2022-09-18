<?php
$connect = new PDO("mysql:host=localhost;dbname=webdieminln", "root", "");
include('../Config/constants.php');
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if (!isset($_SESSION['acc_account_type'])) {
    header("location:../templates/login.php");
}
$application_id = $_GET['application_id'];
// gửi mail cho sinh viên nếu giảng viên đã duyệt mail
$sql_email_sv = "SELECT account.student_email
    FROM ( application
          INNER JOIN account ON account.student_id=application.student_id)
          WHERE application.application_id='$application_id'";
$result = mysqli_query($conn, $sql_email_sv);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $student_email = $row['student_email'];
}
// tìm email trưởng bộ môn
$sql_email_teacher = "SELECT students.student_id,teacher.teacher_id,teacher.teacher_name,account.student_email
from (( students
      INNER JOIN teacher ON teacher.major_id=students.major_id)
      INNER JOIN account ON account.student_id=teacher.teacher_id)
      WHERE students.student_id='b123456' AND students.major_id=teacher.major_id AND account.account_type='3'";
$result_email_teacher = mysqli_query($conn, $sql_email_teacher);
if (mysqli_num_rows($result_email_teacher) > 0) {
    $row = mysqli_fetch_assoc($result_email_teacher);
    $teacher_email = $row['student_email'];
}

$data = array(
    ':student_email'   =>  $student_email,
    ':teacher_email'   =>  $teacher_email

);
// $statement->execute($data);
// end gửi mail cho sinh viên nếu giảng viên đã duyệt mail


$sql = "UPDATE `application` SET `cvgd_status`='1' WHERE application_id='$application_id'";
$statement = $connect->prepare($sql);
$statement->execute($data);

$mail = new PHPMailer();
$mail->isSMTP();
$mail->CharSet  = "utf-8";
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->Username = "thanhlan581@gmail.com";
$mail->Password = "aulp lcnw abty txzs";
$mail->Subject = "Hệ Thống Xin Điểm I CTU Thông Báo Duyệt Đơn";
$mail->setFrom("thanhlan581@gmail.com");
$mail->Body = "Xin chào $student_email,<br>
            Đơn xin điểm I của bạn đã được giảng viên duyệt<br>
            Theo dõi tiếp quá trình duyệt đơn tại website của chúng tôi <br>
            Xin cám ơn!
            ";
$mail->addAddress($student_email);
$mail->isHTML(true);
if ($mail->send()) {
    // header("location:../templates/varifyotp.php?student_id=" . $student_id);
    header('location:quanlydon_giangvien.php?m=1');
} else {
    $message = $mail->ErrorInfo;
}
$mail->smtpClose('');

// gửi mail cho trưởng bộ môn thông báo có đơn cần duyệt
$mail = new PHPMailer();
$mail->isSMTP();
$mail->CharSet  = "utf-8";
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->Username = "thanhlan581@gmail.com";
$mail->Password = "aulp lcnw abty txzs";
$mail->Subject = "Hệ Thống Xin Điểm I CTU Thông Báo Duyệt Đơn";
$mail->setFrom("thanhlan581@gmail.com");
$mail->Body = "Xin chào $teacher_email,<br>
            Bạn có đơn xin điểm I cần duyệt<br>
            Tiến hành duyệt đơn tại website của chúng tôi<br>
            Xin cám ơn!
            ";
$mail->addAddress($teacher_email);
$mail->isHTML(true);
if ($mail->send()) {
    // header("location:../templates/varifyotp.php?student_id=" . $student_id);
    // header('location:quanlydon_giangvien.php?m=1');
} else {
    $message = $mail->ErrorInfo;
}
$mail->smtpClose('');
// end gửi mail cho giảng viên thông báo có đơn cần duyệt
// if (mysqli_query($conn, $sql)) {
//     // echo"<script>alert('duyệt đơn thành công')</script>"; 
//     header('location:quanlydon_giangvien.php?m=1');
// } else {
//     echo "Error deleting record: " . mysqli_error($conn);
// }
