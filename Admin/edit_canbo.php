<?php
include('../Config/constants.php');
session_start();
if (!isset($_SESSION['acc_account_type'])) {
    header("location:../templates/login.php");
} else {
    if ($_SESSION['acc_account_type'] != 1) {
        header("location:../templates/login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="giangvien_index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Hệ Thống Xin Vắng Thi - Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
    </style>
    <title>Hệ Thống Xin Vắng Thi - Admin</title>
</head>
<style>
    body {
        min-height: 100vh;
    }

    .header {
        position: fixed;
        width: 100%;
        top: 0;
    }

    .main-content {
        padding-top: 100px;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .nav-bar {
        background-color: #06bee1;
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 5%), inset 0 -1px 0 rgb(0 0 0 / 15%);
    }

    .slider {
        margin-top: 10px;
    }

    .icon-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        color: #06bee1;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 50%;
    }

    .icon-button:hover {
        cursor: pointer;
    }

    .icon-button:active {
        background: #cccccc;
    }

    .icon-button__badge {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 25px;
        height: 25px;
        margin-top: 5px;
        background: red;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
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

    .bg-modal {
        background: #fffcf7;
    }
</style>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="nav-bar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#" style="font-family: 'Maven Pro', sans-serif;font-size:25px;color:#fff;margin-right:100px">
                            <img src="../css/image/bg.png" alt="" width="60" height="60" class="d-inline-block">
                            Hệ Thống Xin Vắng Thi CTU
                        </a>

                    </div>
                </nav>
            </div>
        </div>
        <?php
        $teacher_id = $_GET['teacher_id'];
        $sql_edit = "SELECT * FROM teacher WHERE teacher_id = $teacher_id";
        $result_edit = mysqli_query($conn, $sql_edit);
        $data = mysqli_fetch_array($result_edit, MYSQLI_ASSOC);


        // // $teacher_id = $_GET['teacher_id'];
        $sql_account_type = "SELECT * FROM account WHERE student_id = $teacher_id";
        $result_account_type = mysqli_query($conn, $sql_account_type);
        $account_type = mysqli_fetch_array($result_account_type, MYSQLI_ASSOC);


        $sql_role = "SELECT * FROM roles;";
        $result_role = mysqli_query($conn, $sql_role);
        $role_list = [];
        while ($row = mysqli_fetch_array($result_role, MYSQLI_ASSOC)) {
            $role_list[] = [
                'role_id' => $row['role_id'],
                'role_name' => $row['role_name'],
            ];
        }

        $sql_major = "SELECT * FROM major;";
        $result_major = mysqli_query($conn, $sql_major);
        $major_list = [];
        while ($row = mysqli_fetch_array($result_major, MYSQLI_ASSOC)) {
            $major_list[] = [
                'major_id' => $row['major_id'],
                'major_name' => $row['major_name'],
            ];
        }

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

        <section class="form-fill">
            <div class="container-fluid" style="width: 600px ;margin-top: 100px;">
                <form class="main-form" action="" method="POST" style="border:1px solid;padding: 30px;margin-top: 30px; margin-bottom:30px;background: #fffcf7;border-color:#06bee1;border-radius:5px">
                    <h4 style="text-align: center;">Cập Nhật Thông Tin Cán Bộ</h4>
                    <div class="col-md-12">
                        <div col-md-12>
                            <div class="form-group">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label for="teacher_name" class="form-label required">Họ Tên : <?= $data['teacher_name']; ?></label>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="teacher_birthday" class="form-label required">Ngày Sinh : <?= $data['teacher_birthday']; ?></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="teacher_sex" class="form-label required">Giới Tính : <?= $data['sex_id']; ?></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="teacher_birthplace" class="form-label required">Địa Chỉ : <?= $data['teacher_birthplace']; ?></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="major_id" class="form-label required">Bộ Môn</label>
                                        <select name="major_id" id="major_id" class="form-select" required>
                                            <?php foreach ($major_list as $major_ls) : ?>
                                                <?php
                                                $major_selected = '';
                                                $major_edit = $data['major_id'];
                                                if ($major_ls['major_id'] == $major_edit) {
                                                    $major_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $major_ls['major_id'] ?>" <?= $major_selected ?>><?= $major_ls['major_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="faculty_id" class="form-label required">Khoa</label>
                                        <select name="faculty_id" id="faculty_id" class="form-select" required>
                                            <?php foreach ($faculty_list as $faculty_ls) : ?>
                                                <?php
                                                $faculty_selected = '';
                                                $faculty_edit = $data['faculty_id'];
                                                if ($faculty_ls['faculty_id'] == $faculty_edit) {
                                                    $faculty_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $faculty_ls['faculty_id'] ?>" <?= $faculty_selected ?>><?= $faculty_ls['faculty_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="role_id" class="form-label required">Chức Vụ</label>
                                        <select name="role_id" id="role_id" class="form-select" required>
                                            <?php foreach ($role_list as $role_ls) : ?>
                                                <?php
                                                $role_selected = '';
                                                $role_edit = $account_type['account_type'];
                                                if ($role_ls['role_id'] == $role_edit) {
                                                    $role_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $role_ls['role_id'] ?>" <?= $role_selected ?>><?= $role_ls['role_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>


                        <br>

                    </div>
                    <div class="modal-footer">
                    <a href="index_Admin.php"><button type="button" class="edit_button border border-white">Trở Lại</button></a>
                        <input style="margin-left:40px" type="submit" name="canbo_edit" id="canbo_edit" class="edit_button border border-white" value="Cập Nhật">
                    </div>
                </form>
            </div>
    </div>
    </section>
    </div>

    <?php include "../Sinhvien/footer.html" ?>


    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.14/dist/sweetalert2.min.js"></script>


</body>

</html>

<?php
$teacher_id = $_GET['teacher_id'];
if (isset($_POST['canbo_edit'])) {
    $major_id = $_POST['major_id'];
    $faculty_id = $_POST['faculty_id'];
    $role_id = $_POST['role_id'];
    $teacher_edit = "UPDATE `teacher` SET `major_id`='$major_id',`faculty_id`='$faculty_id'
    WHERE `teacher_id`='$teacher_id'";
    $role_edit = "UPDATE `account` SET `account_type`='$role_id' WHERE `student_id`='$teacher_id'";
    if (mysqli_query($conn, $teacher_edit) && (mysqli_query($conn, $role_edit))) {
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
                        location.href = 'index_Admin.php';
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