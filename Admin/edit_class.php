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
        $class_id = $_GET['class_id'];
        $sql_subject = "SELECT *
        FROM (class
              INNER JOIN subject ON subject.subject_id=class.subject_id) WHERE `class_id`='$class_id'";
        $result_subject = mysqli_query($conn, $sql_subject);
        $data = mysqli_fetch_array($result_subject, MYSQLI_ASSOC);

        $sql_teacher = "SELECT * FROM teacher;";
        $result_teacher = mysqli_query($conn, $sql_teacher);
        $teacher_list = [];
        while ($row = mysqli_fetch_array($result_teacher, MYSQLI_ASSOC)) {
            $teacher_list[] = [
                'teacher_id' => $row['teacher_id'],
                'teacher_name' => $row['teacher_name'],
            ];
        }

        ?>

        <section class="form-fill">
            <div class="container-fluid" style="width: 600px ;margin-top: 100px;">
                <form class="main-form" action="" method="POST" style="border:1px solid;padding: 30px;margin-top: 30px; margin-bottom:30px;background: #fffcf7;border-color:#06bee1;border-radius:5px">
                    <h4 style="text-align: center;">Cập Nhật Giảng Viên Phụ Trách</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="subject_name" class="form-label required">Tên Học Phần: <?= $data['subject_name']; ?></label>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="subject_name" class="form-label required">Mã Lớp Học Phần: <?= $data['class_id']; ?></label>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->

                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <label for="teacher_id" class="col-form-label">Giảng viên phụ trách:</label>
                        </div>
                        <div class="col-auto">
                            <select name="teacher_id" id="teacher_id" class="form-select" required>
                                <?php foreach ($teacher_list as $teacher_ls) : ?>
                                    <?php
                                    $teacher_selected = '';
                                    $teacher_edit = $data['teacher_id'];
                                    if ($teacher_ls['teacher_id'] == $teacher_edit) {
                                        $teacher_selected = 'selected';
                                    }
                                    ?>
                                    <option value="<?= $teacher_ls['teacher_id'] ?>" <?= $teacher_selected ?>><?= $teacher_ls['teacher_id']?>-<?= $teacher_ls['teacher_name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!--  -->
                    <br>

                    <div class="modal-footer">
                        <a href="lophoc.php"><button type="button" class="edit_button border border-white">Trở Lại</button></a>
                        <input style="margin-left:40px" type="submit" name="update_class" id="update_class" class="edit_button border border-white" value="Cập Nhật">
                    </div>
                </form>
            </div>
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
$class_id = $_GET['class_id'];
if (isset($_POST['update_class'])) {
    $teacher_id = $_POST['teacher_id'];
    $sql = "UPDATE `class` SET `teacher_id`='$teacher_id' WHERE `class_id`='$class_id'";
    if (mysqli_query($conn, $sql)) {
?>

        <div class="flash-data" data-flashdata=1></div>
        <script>
            const flashdata = $('.flash-data').data('flashdata')
            if (flashdata) {
                Swal.fire(
                    'Thành công!',
                    'Đã cập nhật học phần.',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'lophoc.php';
                    }
                })
            }
        </script>
    <?php
    } else {
    ?>
        <div class="flash-data" data-flashdata=1></div>
        <script>
            const flashdata = $('.flash-data').data('flashdata')
            if (flashdata) {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại',
                    text: 'Chưa cập nhật học phần, vui lòng kiểm tra lại'
                })
            }
        </script>
<?php
    }
}
?>