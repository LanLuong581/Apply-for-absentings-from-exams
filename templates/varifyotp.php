<?php
$connect = new PDO("mysql:host=localhost;dbname=webdieminln", "root", "");
$error_otp = '';
$student_id = '';
$message = '';
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
    <title>Xác Thực OTP</title>
</head>
<style>
    body {
        background: linear-gradient(0deg, rgba(63, 112, 214, 1) 0%, rgba(45, 253, 191, 1) 99%);
    }

    .avatar {
        width: 100px;
    }

    .main-content {
        min-height: 621px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;

    }

    .main-form {
        background: #fff;
        border: 0px solid;
        padding: 30px;
        margin-top: 50px;
        border-radius: 15px;
        -webkit-box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
        -moz-box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
        box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
    }
</style>

<body>
    <!-- <div class="container"> -->
    <!-- <div id="header"></div> -->
    <div class="main-content">
        <div class="container-fluid" style="width: 500px ;margin-top: 30px;">
            <form class="main-form" action="" method="post" style="margin-top: 100px;border: 0px solid;padding: 30px;">
                <h4>Xác Thực Mã OTP</h4>
                <?php echo $message; ?>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="otp" id="otp">
                            <?php echo $error_otp; ?>
                        </div>
                    </div>
                </div>
                <br>
                <div style="text-align: center;">
                    <input type="submit" name="submit_otp" id="submit_otp" class="btn btn-primary" value="Xác nhận">
                </div>
            </form>
        </div>
    </div>
    <!-- <div id="footer"></div> -->
    <!-- </div> -->
    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>
<?php

if (isset($_GET["student_id"])) {
    $student_id = $_GET["student_id"];
    if (isset($_POST["submit_otp"])) {
        if (empty($_POST["otp"])) {
            $error_otp = '<label class="text-danger">Nhap ma otp</label>';
        } else {
            $query = "select * from account where student_id='" . $student_id . "' and otp='" . trim($_POST["otp"]) . "'";
            $statement = $connect->prepare($query);
            $statement->execute();
            $total_row = $statement->rowCount();
            if ($total_row > 0) {

                $query = "update account set account_status='1' where student_id='" . $student_id . "' ";
                $statement = $connect->prepare($query);
                if ($statement->execute()) {
?>
                    <div class="flash-data" data-flashdata=1></div>
                    <script>
                        const flashdata = $('.flash-data').data('flashdata')
                        if (flashdata) {
                            Swal.fire(
                                'Xác thực OTP thành công.',
                                'Tiến hành đăng nhập',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = 'login.php';

                                }
                            })
                        }
                    </script>
                <?php
                }
            } else {
                ?>
                <div class="flash-data" data-flashdata=1></div>
                <script>
                    const flashdata = $('.flash-data').data('flashdata')
                    if (flashdata) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Mã OTP chưa đúng',
                            text: 'Vui lòng kiểm tra lại!'
                        })
                    }
                </script>
<?php
            }
        }
    }
}
?>