<?php
$connect = new PDO("mysql:host=localhost;dbname=webdieminln", "root", "");
include('../Config/constants.php');
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$message = '';
$error_student_id = '';
$error_student_email = '';
$error_password = '';
$error_repassword = '';
$student_id = '';
$student_email = '';
$password = '';
$repassword = '';

if (isset($_POST['submit_register'])) {
    if (empty($_POST["student_id"])) {
        $error_student_id = '<label class="text-danger">Nhập Mã Số Sinh Viên</label>';
    } else {
        $student_id = trim($_POST["student_id"]);
        $student_id = htmlentities($student_id);
    }

    if (empty($_POST['student_email'])) {
        $error_student_email = "<label class='text-danger'>Nhập email sinh vien</label>";
    } else {
        $student_email = trim($_POST["student_email"]);
        if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
            $error_student_email = '<label class="text-danger">Nhập đúng email</label>';
        }
    }

    if (empty($_POST['password'])) {
        $error_password = "<label class='text-danger'>Nhập mật khẩu</label>";
    } else {
        $password = trim($_POST["password"]);
        $password = md5($password);
    }

    if (empty($_POST['repassword'])) {
        $error_repassword = "<label class='text-danger'>Nhập lại mật khẩu</label>";
    } else {
        $repassword = trim($_POST["repassword"]);
        $repassword = md5($repassword);
        if ($repassword != $password) {
            $error_repassword = "<label class='text-danger'>Mật khẩu nhập lại không đúng</label>";
        }
    }

    if ($error_student_id == '' && $error_student_email == '' && $error_password == '' && $error_repassword == '') {
        $otp = rand(100000, 999999);
        $data = array(
            ':student_id'   =>  $student_id,
            ':student_email'    =>  $student_email,
            ':password' =>  $password,
            ':account_type' =>  '5',
            ':account_status'   =>  '0',
            ':otp'  =>  $otp
        );
        $email_query = "select * from account where student_email='" . $student_email . "'";
        $statement_email = $connect->prepare($email_query);
        $statement_email->execute();
        $total_row = $statement_email->rowCount();

        if ($total_row > 0) {
            $message = '<label class="text-danger">Email này đã tồn tại</label>';
        } else {
            $query = "INSERT INTO `account`(`student_id`, `password`,`student_email`, `account_type`, `otp`, `account_status`)
            SELECT * FROM (SELECT :student_id,:password,:student_email,:account_type,:otp,:account_status) AS tmp
            WHERE NOT EXISTS(
                SELECT student_email from account where student_email= :student_email) LIMIT 1";
            $statement = $connect->prepare($query);
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
            $mail->Subject = "Hệ Thống Xin Điểm I CTU Xác thực email";
            $mail->setFrom("thanhlan581@gmail.com");
            $mail->Body = "Xin chào $student_id,<br>
            Bạn đang đăng ký tài khoản Hệ Thống Xin Điểm I của trường Đại Học Cần Thơ<br>
            Mã xác thực của bạn là $otp";
            $mail->addAddress($student_email);
            $mail->isHTML(true);
            if ($mail->send()) {
                header("location:../templates/varifyotp.php?student_id=" . $student_id);
            } else {
                $message = $mail->ErrorInfo;
            }
            $mail->smtpClose('');
            // $query_info="INSERT INTO `students`(`student_id`, `student_name`, `major_id`, `faculty_id`, `student_sex`, `student_birthday`, `student_birthplace`, `student_phone`, `student_course`, `student_acadamicyear`) 
            // VALUES ('$student_id','trống','999','999','trống','1990-01-01','trống','trống','0','trống')";
            $query_info="INSERT INTO `students`(`student_id`, `student_name`, `major_id`, `faculty_id`, `sex_id`, `student_birthday`, `student_birthplace`, `student_phone`, `course_id`, `academicyear_id`) 
            VALUES ('$student_id','Chưa Cập Nhật','999','999','999','1990-01-01','Chưa Cập Nhật','Chưa Cập Nhật','999','999')";
            mysqli_query($conn, $query_info);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/checker.js"></script>
    <title>Hệ thống xin vắng thi(điểm i)</title>
</head>

<style>
    body {
        background: linear-gradient(0deg, rgba(63, 112, 214, 1) 0%, rgba(45, 253, 191, 1) 99%);
        min-height: 100vh;
        /* height: 100%; */
        padding-top: 50px;
    }

    .avatar {
        width: 100px;
    }

    .main-content {
       
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .main-form {
        background: #fff;
        border: 0px solid;
        padding: 30px;
        /* margin-top: 50px; */
        border-radius: 15px;
        -webkit-box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
        -moz-box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
        box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
    }
</style>

<body>
    <!-- header -->
    <div id="header"></div>
    <!-- body -->
    <div>
        <div class="main-content">
            <div class="container-fluid" style="width: 500px;text-align:center">
                <form class="main-form" action="" method="POST">
                    <div class="col-md-12"><img class="avatar" src="../css/image/avt.svg" alt="">
                        <h4>Đăng Ký</h4>
                        <?php echo $message; ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control form_data" name="student_id" id="student_id" placeholder="Mã Số Sinh Viên">
                                        <label for="floatingInput">Mã Số Sinh Viên</label>
                                    </div>
                                    <?php echo $error_student_id; ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" >
                            <div class="form-group" style="display: inline;">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control form_data" name="student_email" id="student_email" placeholder="Email Sinh Viên">
                                        <label for="floatingInput">Email Sinh Viên</label>

                                    </div>
                                    <?php echo $error_student_email; ?>

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control form_data" name="password" id="password" placeholder="Mật Khẩu">
                                        <label for="floatingInput">Mật Khẩu</label>
                                    </div>
                                    <?php echo $error_password; ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control form_data" name="repassword" id="repassword" placeholder="Nhập Lại Mật Khẩu">
                                        <label for="floatingInput">Nhập Lại Mật Khẩu</label>
                                    </div>
                                    <?php echo $error_repassword; ?>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div style="text-align: center;">
                            <input type="submit" onclick="return validate();"  name="submit_register" id="submit_register" class="btn btn-primary" value="Xác Nhận">
                        </div>
                        <br>
                        <div class="row">
                            <p style="text-align:center">Bạn đã có tài khoản? <a href="../templates/login.php" style="color: red;text-decoration:none">Đăng nhập</a></p>
                        </div>
                    </div>
            </div>
            <br>
            </form>
        </div>
    </div>
    </div>
    <!-- footer -->
    <div id="footer"></div>
    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>

