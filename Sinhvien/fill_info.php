<?php
include('../Config/constants.php');
if (isset($_GET["student_id"])) {
    $student_id = $_GET["student_id"];
    if (isset($_POST["submit"])) {
        $student_name = $_POST['student_name'];
        $student_sex = $_POST['student_sex'];
        $student_birthday = $_POST['student_birthday'];
        $student_birthplace = $_POST['student_birthplace'];
        $student_phone = $_POST['student_phone'];
        $faculty_id = $_POST['faculty_id'];
        $major_id = $_POST['major_id'];
        $Class_ID = $_POST['Class_ID'];
        $student_course = $_POST['student_course'];
        $student_acadamicyear = $_POST['student_acadamicyear'];
        $sql = "INSERT INTO `students`(`student_id`, `student_name`,`Class_ID`, `major_id`, `faculty_id`, `student_sex`, `student_birthday`, `student_birthplace`, `student_phone`, `student_course`, `student_acadamicyear`) 
                VALUES ('$student_id','$student_name',$Class_ID,'$major_id','$faculty_id','$student_sex','$student_birthday','$student_birthplace','$student_phone','$student_course','$student_acadamicyear')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Đã thêm thông tin sinh viên')</script>";
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
  .main-form{
    border: 0px solid;
    padding: 30px;
    margin-top: 50px;
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
                <form class="main-form" action="" method="POST" style="margin-top: 100px;border: 0px solid;padding: 30px;">
                    <h4 style="text-align:center;">Điền Thông Tin Sinh Viên</h4>
                    <div class="col-md-12">
                        <h5>Thông tin cá nhân</h5>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="student_name" class="form-label required">Họ Tên sinh viên</label>
                                    <input type="text" class="form-control" name="student_name" id="student_name">
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_sex" class="form-label required">Giới Tính</label>
                                    <select class="form-select" aria-label="" name="student_sex" id="student_sex">
                                        <option selected value="1">Nữ</option>
                                        <option value="2">Nam</option>
                                        <option value="3">Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_birthday" class="form-label required">Ngày Sinh</label>
                                    <input type="date" class="form-control" name="student_birthday" id="student_birthday">
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_birthplace" class="form-label required">Nơi Sinh</label>
                                    <input type="text" class="form-control" name="student_birthplace" id="student_birthplace">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_phone" class="form-label required">Số Điện Thoại</label>
                                    <input type="text" class="form-control" name="student_phone" id="student_phone">
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
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="student_name" class="form-label required">Mã Lớp</label>
                                    <input type="text" class="form-control" name="Class_ID" id="Class_ID">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_course" class="form-label required">Khóa</label>
                                    <select name="student_course" id="student_course" required>
                                        <?php
                                        for ($i = 43; $i < 50; $i++) {

                                            echo "<option>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_acadamicyear" class="form-label required">Năm Học</label>
                                    <select name="student_acadamicyear" id="student_acadamicyear" required>
                                        <?php
                                        for ($i = date('Y') - 5; $i < date('Y'); $i++) {
                                            $nextyear = $i + 4;
                                            echo "<option>$i - $nextyear </option>";
                                        }
                                        ?>
                                    </select>
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