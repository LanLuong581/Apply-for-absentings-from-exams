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
    <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
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
        transform: translateX(-2px);
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
        /* transform: translateX(-2px); */
    }

    .bg-modal {
        background: #fffcf7;
    }
</style>

<body>
    <!-- navbar -->
    <div class="wrapper">
        <div class="header">
            <div class="nav-bar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#" style="font-family: 'Maven Pro', sans-serif;font-size:25px;color:#fff;margin-right:100px">
                            <img src="../css/image/bg.png" alt="" width="60" height="60" class="d-inline-block">
                            Hệ Thống Xin Vắng Thi CTU
                        </a>


                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" style=" color: #FFFFFF;margin-right:60px" href="index_Admin.php">Cán Bộ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" style=" color: #FFFFFF;margin-right:60px" href="sinhvien.php">Sinh Viên</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" style=" color: #FFFFFF;margin-right:60px" href="lophoc.php">Lớp Học</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" style=" color: #FFFFFF;margin-right:60px" href="quanlydon_admin.php">Đơn Xin</a>
                            </li>
                      
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
                                $admin_id = $_SESSION["acc_student_id"];
                                $sql = "SELECT `admin_name`, sex.sex_name, `admin_birthday`, `admin_birthplace`, `admin_phone`, `admin_email` 
                                FROM `admin` INNER JOIN sex ON sex.sex_id=admin.sex_id
                                WHERE admin.admin_id='$admin_id'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Họ Tên Admin:</th>
                                                    <td><?php echo $row['admin_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Giới Tính:</th>
                                                    <td><?php echo $row['sex_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Ngày Sinh:</th>
                                                    <td><?php echo date('d/m/Y', strtotime($row['admin_birthday'])) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col">Địa Chỉ:</th>
                                                    <td><?php echo $row['admin_birthplace'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Số Điện Thoại:</th>
                                                    <td><?php echo $row['admin_phone'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Email:</th>
                                                    <td><?php echo $row['admin_email'] ?></td>
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
        <!-- end modal thông tin cá nhân -->

        <?php
        $admin_id = $_SESSION["acc_student_id"];
        $sql_edit = "SELECT * FROM `admin` WHERE admin_id='$admin_id'";
        $result_admin = mysqli_query($conn, $sql_edit);
        $data = mysqli_fetch_array($result_admin, MYSQLI_ASSOC);


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
        <!-- model cập nhật thông tin admin -->
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
                                            <label for="teacher_name" class="form-label required">Họ Tên Admin</label>
                                            <input type="text" class="form-control" name="admin_name" id="admin_name" value="<?= $data['admin_name']; ?>">
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
                                            <label for="admin_birthday" class="form-label required">Ngày Sinh</label>
                                            <input type="date" class="form-control" name="admin_birthday" id="admin_birthday" value="<?= $data['admin_birthday']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="admin_birthplace" class="form-label required">Địa Chỉ</label>
                                            <input type="text" class="form-control" name="admin_birthplace" id="admin_birthplace" value="<?= $data['admin_birthplace']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="admin_phone" class="form-label required">Số Điện Thoại</label>
                                            <input type="text" class="form-control" name="admin_phone" id="admin_phone" value="<?= $data['admin_phone']; ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <input type="submit" name="capnhat" id="capnhat" class="btn btn-primary" value="Cập Nhật">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end model cập nhật thông tin admin -->


    </div>
    <!-- body -->
    <div class="main-content">
        <div class="canbo">
            <form action="">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="text-align: center;">Danh Sách Đơn Xin</h4>
                            <?php
                            // $student_id = $_SESSION["acc_student_id"];
                            $sn = 1;
                            $sql = "SELECT application.application_id,application.student_id,students.student_name,
                            subject.subject_name,application.class_id,semester.semester_name,year.year_name,application.reasons,
                            application.cvgd_status,application.bm_status,application.tk_status
                            FROM (((( application
                                  INNER JOIN students ON students.student_id = application.student_id)
                                  INNER JOIN subject ON subject.subject_id=application.subject_id)
                                  INNER JOIN semester ON semester.semester_id=application.semester_id)
                                  INNER JOIN year ON year.year_id=application.year_id) ORDER BY application.application_id DESC";

                            $result = mysqli_query($conn, $sql);
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã Đơn</th>
                                        <th>MSSV</th>
                                        <th>Họ Tên</th>
                                        <th>Môn Học</th>
                                        <th>Mã Lớp</th>
                                        <th>Học Kì</th>
                                        <th>Năm Học</th>
                                        <th>Lý Do</th>
                                        <th>Giảng Viên</th>
                                        <th>Bộ Môn</th>
                                        <th>Trưởng Khoa</th>
                                        <th>Tác Vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $sn++ ?></td>
                                                <td><?php echo $row['application_id'] ?></td>
                                                <td><?php echo $row['student_id'] ?></td>
                                                <td><?php echo $row['student_name'] ?></td>
                                                <td><?php echo $row['subject_name'] ?></td>
                                                <td><?php echo $row['class_id'] ?></td>
                                                <td><?php echo $row['semester_name'] ?></td>
                                                <td><?php echo $row['year_name'] ?></td>
                                                <td><?php echo $row['reasons'] ?></td>
                                                <td><?php
                                                if($row['cvgd_status']=='1'){
                                                    echo "Đã Duyệt";}
                                                else{
                                                    echo "Chưa Duyệt";
                                                } ?>
                                                 </td>
                                                 <td><?php
                                                if($row['bm_status']=='1'){
                                                    echo "Đã Duyệt";}
                                                else{
                                                    echo "Chưa Duyệt";
                                                } ?>
                                                 </td>
                                                 <td><?php
                                                if($row['tk_status']=='1'){
                                                    echo "Đã Duyệt";}
                                                else{
                                                    echo "Chưa Duyệt";
                                                } ?>
                                                 </td>
                                                <td>
                                                    
                                                    <a class="delete" href="delete_application.php?application_id=<?php echo $row['application_id'] ?>"><button type="button" class="bi bi-trash" style="border:0px;font-size:20px"></button></a>

                                                </td>

                                                <td class="del_edit">


                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "Chưa có dữ liệu";
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

            </form>
        </div>
    </div>
    <!-- footer -->
    <div>
        <?php include "../Sinhvien/footer.html" ?>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
<!-- cap nhat thong tin admin -->
<?php
    $admin_id = $_SESSION["acc_student_id"];
    if (isset($_POST["capnhat"])) {
        $admin_name = $_POST['admin_name'];
        $sex_id = $_POST['sex_id'];
        $admin_birthday = $_POST['admin_birthday'];
        $admin_birthplace = $_POST['admin_birthplace'];
        $admin_phone = $_POST['admin_phone'];
        $sql = "UPDATE `admin` SET `admin_name`='$admin_name',`sex_id`='$sex_id',
    `admin_birthday`='$admin_birthday',`admin_birthplace`='$admin_birthplace',`admin_phone`='$admin_phone'
    WHERE admin_id='$admin_id'";
        if (mysqli_query($conn, $sql)) {
            // echo "<script>alert('Đã cập nhật thông tin sinh viên')</script>";
    ?>
            <div class="flash-data" data-flashdata=1></div>
            <script>
                const flashdata = $('.flash-data').data('flashdata')
                if (flashdata) {
                    Swal.fire(
                        'Thành công.',
                        'Đã cập nhật thông tin admin',
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
    ?>
    <!-- end cap nhat thong tin admin -->
    <!-- xoa can bo -->
    <?php if (isset($_GET['a'])) : ?>
        <div class="delete" data-flashdata="<?= $_GET['a']; ?>"></div>
    <?php endif; ?>
    <script>
        $('.delete').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            console.log(self.data('title'));
            Swal.fire({
                title: 'Bạn có chắc muốn xóa đơn này?',
                // text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Chắc chắn!'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = self.attr('href');
                }
            })

        })
        const flashdata = $('.delete').data('flashdata')
        if (flashdata) {
            Swal.fire(
                'Đã xóa!',
                'đơn đã được xóa.',
                'success'
            )
        }
    </script>
    <!-- end xoa can bo -->

</body>

</html>