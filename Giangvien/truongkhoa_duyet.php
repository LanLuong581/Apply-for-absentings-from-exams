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
//  bo mon duyet bang cach cap nhat bm_status =1
$application_id = $_GET['application_id'];

// gửi mail cho sinh viên nếu trưởng khoa duyệt mail
$sql_email_sv = "SELECT account.student_email
FROM ( application
      INNER JOIN account ON account.student_id=application.student_id)
      WHERE application.application_id='$application_id'";
$result = mysqli_query($conn, $sql_email_sv);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $student_email = $row['student_email'];
}
$data = array(
    ':student_email'   =>  $student_email,
    // ':teacher_email'   =>  $teacher_email

);

$sql = "UPDATE `application` SET `tk_status`='1' WHERE application_id='$application_id'";
$sql_diem = "INSERT INTO `diem`(`diem_name`, `application_id`, `semester_id`, `year_id`)
     VALUES ('I','$application_id','5','4')";
mysqli_query($conn, $sql_diem);
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
            Đơn xin điểm I của bạn đã được trưởng khoa duyệt<br>
            Xem tại website của chúng tôi <br>
            Xin cám ơn!
            ";
$mail->addAddress($student_email);
$mail->isHTML(true);
if ($mail->send()) {
    // header("location:../templates/varifyotp.php?student_id=" . $student_id);
    header('location:quanlydon_truongkhoa.php?m=1');
} else {
    $message = $mail->ErrorInfo;
}
$mail->smtpClose('');
// if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql_diem)) {
//     // echo"<script>alert('xóa đơn thành công')</script>"; 
//     header('location:quanlydon_truongkhoa.php?m=1');
// } else {
//     echo "Error deleting record: " . mysqli_error($conn);
// }
