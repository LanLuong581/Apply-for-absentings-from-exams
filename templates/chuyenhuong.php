<?php
include('../Config/constants.php');
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
                        <h4>Chọn loại tài khoản</h4>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12"><br>
                                    <!-- <label for="">Vui lòng chọn loại tài khoản</label><br> -->
                                    <input type="radio" name="account_type" value="1"> Sinh Viên
                                    <input type="radio" name="account_type" value="2"> Giảng Viên

                                </div>
                            </div>
                        </div>
                        <br>

                        <div style="text-align: center;">
                            <input type="submit" onclick="return validate();" name="submit_register" id="submit_register" class="btn btn-primary" value="Tiếp Theo">
                        </div>

                    </div>
                </form>

            </div>
            <br>
        </div>
    </div>
    </div>
    <!-- footer -->
    <div id="footer"></div>
    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>
<?php

if(isset($_POST['account_type'])){
    $loaitaikhoan=$_POST['account_type'];
    if($loaitaikhoan=='1'){
       header("location:../Sinhvien/fill_account.php");
    }
    else{
        header("location:../Giangvien/GV_fill_account.php");

    }
}
?>