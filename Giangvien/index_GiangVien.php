<?php
include('../Config/constants.php');
session_start();
if (!isset($_SESSION['acc_account_type'])) {
    header("location:../templates/login.php");
} else {
    if ($_SESSION['acc_account_type'] != 4) {
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
    <title>Hệ Thống Xin Vắng Thi - Giảng viên</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
    </style>
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

    .bg-modal {
        background: #fffcf7;
    }
</style>

<body>
    <div class="wrapper">
        <!-- header -->
        <div class="header">
            <div class="nav-bar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#" style="font-family: 'Maven Pro', sans-serif;font-size:25px;color:#fff;margin-right:800px">
                            <img src="../css/image/bg.png" alt="" width="60" height="60" class="d-inline-block">
                            Hệ Thống Xin Vắng Thi CTU
                        </a>
                        <!-- <div class="box" style="margin-right: 30px;">
                            <div class="notifications">
                                <button type="button" class="icon-button">
                                    <span class="material-icons" style="font-size: 30px;">notifications</span>
                                    <span class="icon-button__badge">2</span>
                                </button>

                            </div>
                        </div> -->

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="MSSV" role="button" data-bs-toggle="dropdown" aria-expanded="false" style=" color: #FFFFFF;margin-right:60px">
                                    <?php
                                    if (isset($_SESSION["acc_student_id"])) {
                                        echo ($_SESSION["acc_student_id"]);
                                    }

                                    ?>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li data-bs-toggle="modal" data-bs-target="#ModalThongTin"><a class="dropdown-item bi bi-person"> Thông tin cá nhân</a></li>
                                    <!-- Button trigger modal -->

                                    <li><a class="dropdown-item bi bi-box-arrow-right" href="../templates/logout.php"> Đăng Xuất</a></li>

                                </ul>
                            </li>


                        </ul>
                    </div>
                </nav>
            </div>

        </div>
        <!-- end header -->

        <!-- Modal Thông Tin Cá Nhân -->
        <div class="modal fade" id="ModalThongTin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content bg-modal">
                    <div class="modal-header" style="background: #06bee1;">
                        <h5 class="modal-title" id="exampleModalLabel">Thông Tin Cá Nhân</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-info">
                            <div>
                                <?php
                                $student_id = $_SESSION["acc_student_id"];
                                $sql = "SELECT teacher.teacher_name,roles.role_name,teacher.teacher_birthday,sex.sex_name,teacher.teacher_birthplace,teacher.teacher_phone,major.major_name,faculty.faculty_name
                                FROM (((teacher
                                INNER JOIN faculty ON teacher.faculty_id = faculty.faculty_id)
                                INNER JOIN major ON teacher.major_id = major.major_id)
                                INNER JOIN sex ON teacher.sex_id = sex.sex_id)
                                INNER JOIN account ON teacher.teacher_id=account.student_id
                                INNER join roles ON account.account_type=roles.role_id
                                WHERE teacher.teacher_id='$student_id'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Họ Tên Cán Bộ:</th>
                                                    <td><?php echo $row['teacher_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Chức Vụ</th>
                                                    <td><?php echo $row['role_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Ngày Sinh:</th>
                                                    <td><?php echo date('d/m/Y', strtotime($row['teacher_birthday'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Giới Tính:</th>
                                                    <td><?php echo $row['sex_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Địa Chỉ:</th>
                                                    <td><?php echo $row['teacher_birthplace'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Số Điện Thoại:</th>
                                                    <td><?php echo $row['teacher_phone'] ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col">Bộ Môn:</th>
                                                    <td><?php echo $row['major_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Thuộc Khoa:</th>
                                                    <td><?php echo $row['faculty_name'] ?></td>
                                                </tr>
                                            </thead>
                                        </table>
                            </div>
                    <?php
                                    }
                                } else {
                                    echo "Chưa có dữ liệu";
                                }
                    ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateinfo" data-bs-dismiss="modal" class="btn btn-primary update">Cập Nhật</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // $student_id = $_SESSION["acc_student_id"];
        $sql_edit = "SELECT*FROM teacher WHERE teacher_id= '$student_id' ";
        $result_teacher = mysqli_query($conn, $sql_edit);
        $data = mysqli_fetch_array($result_teacher, MYSQLI_ASSOC);

        $sql_faculty = "SELECT * FROM faculty;";
        $result_faculty = mysqli_query($conn, $sql_faculty);
        $faculty_list = [];
        while ($row = mysqli_fetch_array($result_faculty, MYSQLI_ASSOC)) {
            $faculty_list[] = [
                'faculty_id' => $row['faculty_id'],
                'faculty_name' => $row['faculty_name'],
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

        $sql_sex = "SELECT * FROM sex;";
        $result_sex = mysqli_query($conn, $sql_sex);
        $sex_list = [];
        while ($row = mysqli_fetch_array($result_sex, MYSQLI_ASSOC)) {
            $sex_list[] = [
                'sex_id' => $row['sex_id'],
                'sex_name' => $row['sex_name'],
            ];
        }

        ?>
        <!-- model cập nhật thông tin giảng viên -->
        <div class="modal fade" id="updateinfo" tabindex="-1" aria-labelledby="updateinfo" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-modal">
                    <div class="modal-header" style="background: #06bee1;">
                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Thông Tin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="main-form" action="" method="POST">

                            <div class="col-md-12">

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="teacher_name" class="form-label required">Họ Tên Cán Bộ</label>
                                            <input type="text" class="form-control" name="teacher_name" id="teacher_name" value="<?= $data['teacher_name']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teacher_sex" class="form-label required">Giới Tính</label>
                                            <select name="sex_id" id="sex_id" class="form-select" required>
                                                <?php foreach ($sex_list as $slist) : ?>
                                                    <?php
                                                    $sex_selected = '';
                                                    $sex_edit = $data['sex_id'];
                                                    if ($slist['sex_id'] == $sex_edit) {
                                                        $sex_selected = 'selected';
                                                    }
                                                    ?>
                                                    <option value="<?= $slist['sex_id'] ?>" <?= $sex_selected ?>><?= $slist['sex_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teacher_birthday" class="form-label required">Ngày Sinh</label>
                                            <input type="date" class="form-control" name="teacher_birthday" id="teacher_birthday" value="<?= $data['teacher_birthday']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teacher_birthplace" class="form-label required">Địa Chỉ</label>
                                            <input type="text" class="form-control" name="teacher_birthplace" id="teacher_birthplace" value="<?= $data['teacher_birthplace']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teacher_phone" class="form-label required">Số Điện Thoại</label>
                                            <input type="text" class="form-control" name="teacher_phone" id="teacher_phone" value="<?= $data['teacher_phone']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label for="major_id" class="form-label required">Bộ Môn</label>
                                                <select name="major_id" id="major_id" class="form-select" required>
                                                    <?php foreach ($major_list as $mlist) : ?>
                                                        <?php
                                                        $major_selected = '';
                                                        $major_edit = $data['major_id'];
                                                        if ($mlist['major_id'] == $major_edit) {
                                                            $major_selected = 'selected';
                                                        }
                                                        ?>
                                                        <option value="<?= $mlist['major_id'] ?>" <?= $major_selected ?>><?= $mlist['major_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="faculty_id" class="form-label required">Khoa</label>
                                            <select name="faculty_id" id="faculty_id" class="form-select" required>
                                                <?php foreach ($faculty_list as $flist) : ?>
                                                    <?php
                                                    $faculty_selected = '';
                                                    $faculty_edit = $data['faculty_id'];
                                                    if ($flist['faculty_id'] == $faculty_edit) {
                                                        $faculty_selected = 'selected';
                                                    }
                                                    ?>
                                                    <option value="<?= $flist['faculty_id'] ?>" <?= $faculty_selected ?>><?= $flist['faculty_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="submit_update" id="submit_update" class="btn btn-primary" value="Cập Nhật">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end model cập nhật thông tin giảng viên -->

        <!-- main-content -->
        <div class="main-content">
            <div class="grid">
                <article>
                    <img src="../css/image/hdsd.svg" alt="" width="400px" height="200px">
                    <div class="text">
                        <h4>Hướng Dẫn</h4>
                        <p>Đọc kỹ hướng dẫn sử dụng nhé!</p>
                        <button data-bs-toggle="modal" data-bs-target="#HuongDanGiangVien">Tiếp</button>
                    </div>
                </article>
                <!-- Modal -->
                <div class="modal fade " id="HuongDanGiangVien" tabindex="-1" aria-labelledby="HuongdanLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-modal">
                            <div class="modal-header" style="background: #06bee1;">
                                <h5 class="modal-title" id="HuongdanLabel" style="font-family: 'Lobster', cursive; font-size:30px">Hướng Dẫn</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="text-align: justify;">
                                <p style="font-size: 20px;">Chào mừng bạn đến hệ thống xin vắng thi của Trường đại học Cần Thơ <br><br>
                                <b>Thông tin cá nhân:</b>  Xem và cập nhật thông tin cá nhân tại góc trên cùng bên phải
                                <br>
                                <b>Duyệt đơn:</b> Để duyệt đơn bạn thực hiện các bước sau:
                                    <br>
                                    <u> Bước 1:</u> Vào mục quản lý đơn để xem các đơn cần duyệt<br> <u>Bước 2:</u> Tại cột "Tác Vụ",ấn chọn biểu tượng xem để xem đơn, ấn chọn biểu tượng tích chọn để duyệt đơn hoặc biểu tượng xóa để từ chối<br>
                                    <u> Bước 3:</u> Vào mục "Sửa Điểm" để cập nhật điểm cho sinh viên đã được duyệt đơn<br><u>Bước 4:</u> Đăng xuất tại góc trên cùng bên phải.
                                    <br>Xin cám ơn
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <article>
                    <img src="../css/image/quanly.svg" alt="" width="400px" height="200px">
                    <div class="text">
                        <h4>Quản Lý Đơn</h4>
                        <p>Theo dõi quá trình duyệt đơn hoặc hủy đơn</p>
                        <!-- <button>Tiếp</button> -->
                        <!-- <button><a href="quanlydon.php"></a>Tiếp</button> -->
                        <a href="quanlydon_giangvien.php?student_id=<?php echo $_SESSION["acc_student_id"]; ?>"><button>Tiếp</button></a>

                    </div>
                </article>
                <article>
                    <img src="../css/image/fixpoint.svg" alt="" width="400px" height="200px">
                    <div class="text">
                        <h4>Sửa Điểm</h4>
                        <p>Sửa điểm cho sinh viên sau khi đơn đã được duyệt</p>
                        <a href="diemso.php?student_id=<?php echo $_SESSION["acc_student_id"]; ?>"><button>Tiếp</button></a>
                    </div>
                </article>
            </div>
        </div>
        <!-- end main-content -->
        <!-- footer -->
        <?php include "../Sinhvien/footer.html" ?>

        <!-- end footer -->
    </div>

    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>
<?php
// CẬP NHẬT THÔNG TIN CÁ NHÂN
$student_id = $_SESSION["acc_student_id"];
if (isset($_POST["submit_update"])) {
    $teacher_name = $_POST['teacher_name'];
    $sex_id = $_POST['sex_id'];
    $teacher_birthday = $_POST['teacher_birthday'];
    $teacher_birthplace = $_POST['teacher_birthplace'];
    $teacher_phone = $_POST['teacher_phone'];
    $faculty_id = $_POST['faculty_id'];
    $major_id = $_POST['major_id'];
    $sql = "UPDATE `teacher` SET `teacher_name`='$teacher_name',`major_id`='$major_id',`faculty_id`='$faculty_id',`sex_id`='$sex_id',
    `teacher_birthday`='$teacher_birthday',`teacher_birthplace`='$teacher_birthplace',`teacher_phone`='$teacher_phone'
    WHERE `teacher_id`='$student_id'";
    if (mysqli_query($conn, $sql)) {

?>
        <div class="flash-data" data-flashdata=1></div>
        <script>
            const flashdata = $('.flash-data').data('flashdata')
            if (flashdata) {
                Swal.fire(
                    'Thành công.',
                    'Đã cập nhật thông tin cán bộ',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'index_GiangVien.php';
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
                    text: 'Chưa cập nhật thông tin'
                })
            }
        </script>
<?php
    }
}
