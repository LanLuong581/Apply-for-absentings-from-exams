<?php
include('../Config/constants.php');
session_start();
if (!isset($_SESSION['acc_account_type'])) {
    header("location:../templates/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Hệ Thống Xin Vắng Thi CTU</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');

        body {
            min-height: 100vh;
        }

        .main-content {
            min-height: 100vh;
            padding-top: 100px;
        }

        .header {
            position: fixed;
            width: 100%;
            top: 0;
        }

        .nav-bar {
            background-color: #06bee1;
            box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 5%), inset 0 -1px 0 rgb(0 0 0 / 15%);
        }

        .nav-item a:hover {
            cursor: pointer;
        }

        .edit_button {
            cursor: pointer;
            display: inline-block;
            padding: 8px 20px;
            border-radius: 15px;
            margin-left: 70px;
            text-decoration: none;
            background-color: #06bee1;
            color: #fff;
            transition: scaleY scaleX 0.5s;
        }

        .edit_button:hover {
            transform: scaleY(1.05) scaleX(1.05);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="nav-bar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index_GiangVien.php" style="font-family: 'Maven Pro', sans-serif;font-size:25px;color:#fff;margin-right:800px">
                            <img src="../css/image/bg.png" alt="" width="60" height="60" class="d-inline-block">
                            Hệ Thống Xin Vắng Thi CTU
                        </a>
                    </div>
                </nav>

            </div>
        </div>

        <?php
        $application_id = $_GET['application_id'];
        $sql_edit = "SELECT application.application_id, application.student_id,students.student_name,major.major_name,application.subject_id,subject.subject_name,application.class_id,semester.semester_name,year.year_name,diem.diem_name
        FROM (((((((diem
              INNER JOIN application ON application.application_id=diem.application_id)
               INNER JOIN semester ON semester.semester_id=diem.semester_id)
              INNER JOIN year ON year.year_id=diem.year_id)
              INNER JOIN students ON students.student_id=application.student_id)
              INNER JOIN subject ON subject.subject_id=application.subject_id)
               INNER JOIN major ON major.major_id=students.major_id)
              INNER JOIN class ON class.class_id=application.class_id)
             WHERE diem.application_id='$application_id' ORDER BY application.application_id DESC";
        $result_edit = mysqli_query($conn, $sql_edit);
        $data = mysqli_fetch_array($result_edit, MYSQLI_ASSOC);


        $sql_semester = "SELECT * FROM semester;";
        $result_semester = mysqli_query($conn, $sql_semester);
        $semester_list = [];
        while ($row = mysqli_fetch_array($result_semester, MYSQLI_ASSOC)) {
            $semester_list[] = [
                'semester_id' => $row['semester_id'],
                'semester_name' => $row['semester_name'],
            ];
        }

        $sql_year = "SELECT * FROM year;";
        $result_year = mysqli_query($conn, $sql_year);
        $year_list = [];
        while ($row = mysqli_fetch_array($result_year, MYSQLI_ASSOC)) {
            $year_list[] = [
                'year_id' => $row['year_id'],
                'year_name' => $row['year_name'],
            ];
        }

        ?>

        <section class="form-fill">
            <div class="container-fluid" style="width: 600px ;margin-top: 100px;">
                <form class="main-form" action="" method="POST" style="border:1px solid;padding: 30px;margin-top: 30px; margin-bottom:30px;background: #fffcf7;border-color:#06bee1;border-radius:5px">
                    <h4 style="text-align: center;">Cập Nhật Điểm Số</h4>
                    <div class="col-md-12">
                        <div col-md-12>
                            <div class="form-group">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label for="subject_id" class="form-label required">Mã Số: <?= $data['student_id']; ?></label>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label required">Họ Tên: <?= $data['student_name']; ?></label>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="form-group">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label for="semester_id" class="form-label required">Mã Số Học Phần: <?= $data['subject_id']; ?></label>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="year_id" class="form-label required">Tên Học Phần: <?= $data['subject_name']; ?></label>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label for="semester_id" class="form-label required">Học Kỳ: <?= $data['semester_name']; ?></label>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="year_id" class="form-label required">Năm Học: <?= $data['year_name']; ?></label>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <label for="semester_id" class="form-label ">Điểm: </label>
                                        <input type="text" class="form-control" name="diem" id="diem" value="<?= $data['diem']; ?>" required>
                                    </div>

                                </div> -->
                              
                                
                                <div class="row g-4 align-items-center">
                                    <div class="col-auto">
                                        <label for="semester" class="col-form-label">Học Kỳ:</label>
                                    </div>
                                    <div class="col-auto">
                                        <select name="semester_id" id="semester_id" class="form-select" required>
                                            <?php foreach ($semester_list as $semester_ls) : ?>
                                                <option value="<?= $semester_ls['semester_id'] ?>"><?= $semester_ls['semester_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-auto">
                                        <label for="year" class="col-form-label">Năm Học:</label>

                                    </div>
                                    <div class="col-auto">
                                        <select name="year_id" id="year_id" class="form-select" required>
                                            <?php foreach ($year_list as $year_ls) : ?>
                                                <option value="<?= $year_ls['year_id'] ?>"><?= $year_ls['year_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto" style="padding-right: 12px">
                                        <label  for="diem_name" class="col-form-label">Điểm:</label>
                                    </div>
                                    <div class="col-auto" style="padding-left: 12px">
                                        <input  type="text" id="diem_name" name="diem_name" class="form-control" value="<?= $data['diem_name']; ?>" required>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <a href="diemso.php"><button type="button" class="edit_button border border-white">Trở Lại</button></a>
                        <input style="margin-left:40px" type="submit" name="sua_diem" id="sua_diem" class="edit_button border border-white" value="Cập Nhật">
                    </div>
                </form>
            </div>
    </div>
    </section>
    </div>

    <?php include "../Sinhvien/footer.html"; ?>

    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.14/dist/sweetalert2.min.js"></script>

</body>

</html>


<?php
$application_id = $_GET['application_id'];
if (isset($_POST['sua_diem'])) {
    $diem_name = $_POST['diem_name'];
    $semester_id = $_POST['semester_id'];
    $year_id = $_POST['year_id'];
    $sql = "UPDATE `diem` SET `diem_name`='$diem_name',`semester_id`='$semester_id',`year_id`='$year_id',`thoigian`=CURDATE()
    WHERE `application_id`='$application_id'";
    if (mysqli_query($conn, $sql)) {
?>

        <div class="flash-data" data-flashdata=1></div>
        <script>
            const flashdata = $('.flash-data').data('flashdata')
            if (flashdata) {
                Swal.fire(
                    'Thành công!',
                    'Đã cập nhật điểm.',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'diemso.php';
                    }
                })
            }
        </script>
<?php
    } else {
        echo "<script>alert('có gì đó sai')</script>";
    }
}
?>