<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../templates/loader.css">
  <title>Đăng Nhập</title>
</head>

<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;

  }

  body {
    background: linear-gradient(0deg, rgba(63, 112, 214, 1) 0%, rgba(45, 253, 191, 1) 99%);
  }

  .main-content {
    min-height: 653px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }

  .container-fluid {
    text-align: center;
  }

  .avatar {
    width: 100px;
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
  <!-- header -->
  <div id="header"></div>
  <!-- body -->
  <div>
    <div class="main-content">
      <section class="login">
        <div class="container-fluid" style="width: 500px ;margin-top: 0px;">
          <form action="" class="main-form" method="POST" style="margin-top: 100px;border: 0px solid;padding: 0px;">
            <div class="row">
              <div class="form-group">
                <div class="col-md-12" style="padding-top: 30px;">
                  <img class="avatar" src="../css/image/avt.svg" alt="">
                  <h4>Hệ Thống Xin Vắng Thi</h4>
                  <div class="input-dev">
                    <div class="form-floating">
                      <input type="text" class="form-control" name="student_id" id="student_id" value="<?php if(isset($_COOKIE["student_id"])) {echo $_COOKIE["student_id"];}?>" style="width:400px;margin-left:40px;" required placeholder="Mã Số Sinh Viên">
                      <label for="floatingInput" style="margin-left: 40px;">Mã Số</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="form-group">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="password" value="<?php if(isset($_COOKIE["password"])) {echo $_COOKIE["password"];}?>" style="width:400px;margin-left:40px;" required placeholder="Mật Khẩu">
                    <label for="floatingInput" style="margin-left: 40px;">Mật Khẩu</label>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="form-group">
                <div><input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE["student_id"])) { ?> checked <?php } ?> />
                  <label for="remember-me">Remember me</label>
                </div>
              </div>
              <br>
              <div style="text-align: center;">
                <button type="submit" class="btn btn-primary" name="submit" id="submit">Đăng Nhập</button>
              </div>
            </div>
            <br>
            <div class="row">
              <p style="text-align:center">Bạn chưa có tài khoản? <a href="../templates/chuyenhuong.php" style="color: red;text-decoration:none">Đăng ký</a></p>
            </div>
          </form>
        </div>
      </section>
    </div>
  </div>
  <!-- footer -->
  <div id="footer"></div>
  <script src="../js/bootstrap.js"></script>
  <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>
<?php
include('../Config/constants.php');
session_start();
if (isset($_POST['submit'])) {
  $student_id = $_POST["student_id"];
  $password = $_POST["password"];
  // if (isset($_POST["remember"])) {
  //   setcookie("student_id", $student_id, time() + (30), "/");
  //   setcookie("password", $password, time() + (30), "/");
  // } else {
  //   setcookie("student_id", $student_id, 3600, "/");
  //   setcookie("password", $password, 3600, "/");
  // }
  if(!empty($_POST["remember"])){
    setcookie("student_id", $student_id, time() + (1800), "/");
    setcookie("password", $password, time() + (1800), "/");
  }
  else{
    if(isset($_COOKIE["student_id"])){
      setcookie("student_id","");
    }
    if(isset($_COOKIE["password"])){
      setcookie("password","");
    }
  }

  $student_id = $_POST['student_id'];
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM account WHERE student_id='$student_id' AND password='$password' AND account_status='1'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['account_type'] == 5) {
        $_SESSION["acc_student_id"] = $student_id;
        $_SESSION["acc_account_type"] = $row['account_type'];

?>
        <div class="flash-data" data-flashdata=1></div> -->
        <script>
          const flashdata = $('.flash-data').data('flashdata')
          if (flashdata) {
            Swal.fire(
              'Thành công!',
              'Đăng nhập thành công.',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                location.href = '../Sinhvien/index_SinhVien.php';
              }
            })
          }
        </script>
      <?php
      } else if ($row['account_type'] == 4) {
        $_SESSION["acc_student_id"] = $student_id;
        $_SESSION["acc_account_type"] = $row['account_type'];
      ?>
        <div class="flash-data" data-flashdata=1></div>
        <script>
          const flashdata = $('.flash-data').data('flashdata')
          if (flashdata) {
            Swal.fire(
              'Thành công!',
              'Giảng viên đăng nhập thành công.',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                location.href = '../Giangvien/index_Giangvien.php';
              }
            })
          }
        </script>
      <?php
      } else if ($row['account_type'] == 3) {
        $_SESSION["acc_student_id"] = $student_id;
        $_SESSION["acc_account_type"] = $row['account_type'];
      ?>
        <div class="flash-data" data-flashdata=1></div>
        <script>
          const flashdata = $('.flash-data').data('flashdata')
          if (flashdata) {
            Swal.fire(
              'Thành công!',
              'Trưởng bộ môn đăng nhập thành công.',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                location.href = '../Giangvien/index_BoMon.php';
              }
            })
          }
        </script>
      <?php
      } else if ($row['account_type'] == 2) {
        $_SESSION["acc_student_id"] = $student_id;
        $_SESSION["acc_account_type"] = $row['account_type'];
      ?>
        <div class="flash-data" data-flashdata=1></div>
        <script>
          const flashdata = $('.flash-data').data('flashdata')
          if (flashdata) {
            Swal.fire(
              'Thành công!',
              'Trưởng khoa đăng nhập thành công.',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                location.href = '../Giangvien/index_TruongKhoa.php';
              }
            })
          }
        </script>
      <?php
      } else if ($row['account_type'] == 1) {
        $_SESSION["acc_student_id"] = $student_id;
        $_SESSION["acc_account_type"] = $row['account_type'];

      ?>

        <div class="flash-data" data-flashdata=1></div>
        <script>
          const flashdata = $('.flash-data').data('flashdata')
          if (flashdata) {
            Swal.fire(
              'Thành công!',
              'Admin đăng nhập thành công.',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                location.href = '../Admin/index_Admin.php';
              }
            })
          }
        </script>
    <?php
      }
    }
    ?>
  <?php
  } else {
  ?>
    <div class="flash-data" data-flashdata=1></div>
    <script>
      const flashdata = $('.flash-data').data('flashdata')
      if (flashdata) {
        Swal.fire({
          icon: 'error',
          title: 'Không thể đăng nhập',
          text: 'Vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu'
        })
      }
    </script>
<?php
  }
}

$student_id = "";
$password = "";
$check = false;
if (isset($_COOKIE["student_id"]) && isset($_COOKIE["password"])) {
  $student_id = $_COOKIE["student_id"];
  $password = $_COOKIE["password"];
  $check = true;
}
?>