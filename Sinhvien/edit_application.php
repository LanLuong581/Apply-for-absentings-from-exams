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
                        <a class="navbar-brand" href="index_Sinhvien.php" style="font-family: 'Maven Pro', sans-serif;font-size:25px;color:#fff;margin-right:800px">
                            <img src="../css/image/bg.png" alt="" width="60" height="60" class="d-inline-block">
                            Hệ Thống Xin Vắng Thi CTU
                        </a>
                    </div>
                </nav>

            </div>
        </div>

        <?php
        $application_id = $_GET['application_id'];
        $sql_edit = "SELECT * FROM application WHERE application_id = $application_id";
        $result_edit = mysqli_query($conn, $sql_edit);
        $data = mysqli_fetch_array($result_edit, MYSQLI_ASSOC);

        $sql_subject = "SELECT * FROM subject;";
        $result_subject = mysqli_query($conn, $sql_subject);
        $subject_list = [];
        while ($row = mysqli_fetch_array($result_subject, MYSQLI_ASSOC)) {
            $subject_list[] = [
                'subject_id' => $row['subject_id'],
                'subject_name' => $row['subject_name'],
            ];
        }

        $sql_class = "SELECT * FROM class;";
        $result_class = mysqli_query($conn, $sql_class);
        $class_list = [];
        while ($row = mysqli_fetch_array($result_class, MYSQLI_ASSOC)) {
            $class_list[] = [
                'class_id' => $row['class_id'],
            ];
        }

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
                    <h4 style="text-align: center;">Cập Nhật Đơn</h4>
                    <div class="col-md-12">
                        <div col-md-12>
                            <div class="form-group">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label for="subject_id" class="form-label required">Mã Số Học Phần</label>
                                        <select name="subject_id" id="subject_id" class="form-select" required>
                                            <?php foreach ($subject_list as $subject_ls) : ?>
                                                <?php
                                                $subject_selected = '';
                                                $subject_edit = $data['subject_id'];
                                                if ($subject_ls['subject_id'] == $subject_edit) {
                                                    $subject_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $subject_ls['subject_id'] ?>" <?= $subject_selected ?>><?= $subject_ls['subject_id'] ?>-<?= $subject_ls['subject_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label required">Mã Lớp</label>
                                        <select name="class_id" id="class_id" class="form-select" required>
                                            <?php foreach ($class_list as $class_ls) : ?>
                                                <?php
                                                $class_selected = '';
                                                $class_edit = $data['class_id'];
                                                if ($class_ls['class_id'] == $class_edit) {
                                                    $class_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $class_ls['class_id'] ?>" <?= $class_selected ?>><?= $class_ls['class_id'] ?></option>
                                            <?php endforeach; ?>
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
                                        <label for="semester_id" class="form-label required">Học Kỳ</label>
                                        <select name="semester_id" id="semester_id" class="form-select" required>
                                            <?php foreach ($semester_list as $semester_ls) : ?>
                                                <?php
                                                $semester_selected = '';
                                                $semester_edit = $data['semester_id'];
                                                if ($semester_ls['semester_id'] == $semester_edit) {
                                                    $semester_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $semester_ls['semester_id'] ?>" <?= $semester_selected ?>><?= $semester_ls['semester_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="year_id" class="form-label required">Năm Học</label>
                                        <select name="year_id" id="year_id" class="form-select" required>
                                            <?php foreach ($year_list as $year_ls) : ?>
                                                <?php
                                                $year_selected = '';
                                                $year_edit = $data['year_id'];
                                                if ($year_ls['year_id'] == $year_edit) {
                                                    $year_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $year_ls['year_id'] ?>" <?= $year_selected ?>><?= $year_ls['year_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-floating ">
                                        <div class="mb-3">
                                            <label for="reasons" class="form-label required">Lý Do</label>
                                            <textarea class="form-control" name="reasons" id="reasons" required> <?= $data['reasons']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="quanlydon.php"><button type="button" class="edit_button border border-white">Trở Lại</button></a>
                        <input style="margin-left:40px" type="submit" name="application_edit" id="application_edit" class="edit_button border border-white" value="Cập Nhật">
                    </div>
                </form>
            </div>
    </div>
    </section>
    </div>

    <?php include "./footer.html" ?>

    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.14/dist/sweetalert2.min.js"></script>

</body>

</html>


<?php
$application_id = $_GET['application_id'];
if (isset($_POST['application_edit'])) {
    $subject_id = $_POST['subject_id'];
    $class_id = $_POST['class_id'];
    $semester_id = $_POST['semester_id'];
    $year_id = $_POST['year_id'];
    $reasons = $_POST['reasons'];
    $sql = "UPDATE `application` SET `class_id`='$class_id',
    `subject_id`='$subject_id',`semester_id`='$semester_id',`year_id`='$year_id ',`reasons`='$reasons',`date`=SYSDATE()
    WHERE `application_id`='$application_id'";
    if (mysqli_query($conn, $sql)) {
?>

        <div class="flash-data" data-flashdata=1></div>
        <script>
            const flashdata = $('.flash-data').data('flashdata')
            if (flashdata) {
                Swal.fire(
                    'Thành công!',
                    'Thông tin đã được cập nhật.',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'quanlydon.php';
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