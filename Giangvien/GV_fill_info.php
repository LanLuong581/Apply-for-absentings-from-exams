<?php
include('../Config/constants.php');
if (isset($_GET["student_id"])) {
    $student_id = $_GET["student_id"];
    if (isset($_POST["submit"])) {
        $teacher_name = $_POST['teacher_name'];
        $sex_id = $_POST['sex_id'];
        $teacher_birthday = $_POST['teacher_birthday'];
        $teacher_birthplace = $_POST['teacher_birthplace'];
        $teacher_phone = $_POST['teacher_phone'];
        $faculty_id = $_POST['faculty_id'];
        $major_id = $_POST['major_id'];
        $sql = "UPDATE `teacher` SET `teacher_name`='$teacher_name',`major_id`='$major_id',`faculty_id`='$faculty_id',
        `sex_id`='$sex_id',`teacher_birthday`='$teacher_birthday',`teacher_birthplace`='$teacher_birthplace',
        `teacher_phone`='$teacher_phone' WHERE `teacher_id`='$student_id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Đã cập nhật thông tin cán bộ')</script>";
            header("location:../templates/login.php");
        } else {
            echo "<script>alert('có gì đó sai')</script>";
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
    <link rel="stylesheet" href="https://www.jsdelivr.com/package/npm/sweetalert2">
    <title>Thong Tin Sinh Vien</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;

    }
    body {
        background: linear-gradient(0deg, rgba(63, 112, 214, 1) 0%, rgba(45, 253, 191, 1) 99%);
        min-height: 100vh;
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
        border-radius: 15px;
        -webkit-box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
        -moz-box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
        box-shadow: -1px 4px 26px 5px rgba(25, 29, 31, 1);
    }
</style>
<body>
    <div id="container">
        <div id="header"></div>
        <div id="main-content">
            <div class="container-fluid" style="width: 500px ;margin-top: 30px;">
                <form class="main-form" action="" method="POST">
                    <h4 style="text-align:center;">Điền Thông Tin Cán Bộ</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="student_name" class="form-label required">Họ Tên Cán Bộ</label>
                                    <input type="text" class="form-control" name="teacher_name" id="teacher_name">
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sex_id" class="form-label required">Giới Tính</label>
                                    <select class="form-select" aria-label="" name="sex_id" id="sex_id">
                                        <option selected value="1">Nữ</option>
                                        <option value="2">Nam</option>
                                        <option value="3">Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_birthday" class="form-label required">Ngày Sinh</label>
                                    <input type="date" class="form-control" name="teacher_birthday" id="teacher_birthday">
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_birthplace" class="form-label required">Nơi Sinh</label>
                                    <input type="text" class="form-control" name="teacher_birthplace" id="teacher_birthplace">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_phone" class="form-label required">Số Điện Thoại</label>
                                    <input type="text" class="form-control" name="teacher_phone" id="teacher_phone">
                                </div>
                            </div>
                        </div>
                        <?php
                        $sql_faculty = "SELECT * FROM faculty;";
                        $result_faculty = mysqli_query($conn, $sql_faculty);
                        $faculty_list = [];
                        while ($row = mysqli_fetch_array($result_faculty, MYSQLI_ASSOC)) {
                            $faculty_list[] = [
                                'faculty_id' => $row['faculty_id'],
                                'faculty_name' => $row['faculty_name'],
                            ];
                        }
                        ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="faculty_id" class="form-label required">Khoa</label>
                                    <select name="faculty_id" id="faculty_id" class="form-select" required>
                                        <?php foreach ($faculty_list as $flist) : ?>
                                            <option value="<?= $flist['faculty_id'] ?>"><?= $flist['faculty_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                        $sql_major = "SELECT * FROM major;";
                        $result_major = mysqli_query($conn, $sql_major);
                        $major_list = [];
                        while ($row = mysqli_fetch_array($result_major, MYSQLI_ASSOC)) {
                            $major_list[] = [
                                'major_id' => $row['major_id'],
                                'major_name' => $row['major_name'],
                            ];
                        }
                        ?>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="major_id" class="form-label required">Ngành</label>
                                    <select name="major_id" id="major_id" class="form-select" required>
                                        <?php foreach ($major_list as $mlist) : ?>
                                            <option value="<?= $mlist['major_id'] ?>"><?= $mlist['major_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-grid gap-2">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Xác Nhận">
                    </div>
                </form>
            </div>
        </div>
        <div id="footer"></div>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>