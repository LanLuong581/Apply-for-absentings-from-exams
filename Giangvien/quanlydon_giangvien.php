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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Quản Lý Đơn</title>
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

        .icon-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 200px;
            width: 50px;
            height: 50px;
            color: #06bee1;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 50%;
            /* text-decoration: none; */
        }

        .icon-button:hover {
            cursor: pointer;
        }

        .icon-button:active {
            background: #cccccc;
        }

        .svid:hover {
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- header -->
        <div class="header">
            <div class="nav-bar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index_Sinhvien.php" style="font-family: 'Maven Pro', sans-serif;font-size:25px;color:#fff;margin-right:0px">
                            <img src="../css/image/bg.png" alt="" width="60" height="60" class="d-inline-block">
                            Hệ Thống Xin Vắng Thi CTU
                        </a>
                        <form class="d-flex" action="timkiem_giangvien.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Nhập tên sinh viên..." name="search" aria-label="Search" required style="width: 500px;">
                            <button class="btn btn-light" style="color: #06bee1;" type="submit" name="submit">Tìm kiếm</button>
                        </form>
                        <div class="box" style="margin-right: 30px;">
                            <div class="home-btn">
                                <a href="index_Giangvien.php" style="text-decoration: none;"><button type="button" class="icon-button">
                                        <span class="material-symbols-outlined" style="font-size:30px">home</span>
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
        <!-- end header -->

        <!-- main-content -->
        <div class="main-content">
            <div>
                <form class="main-form" action="">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- <div class="col-md-1"> -->

                            </div>
                            <div class="col-md-12">
                                <h3 style="text-align: center;">Danh Sách Đơn Xin</h3>
                                <?php
                                $teacher_id = $_SESSION["acc_student_id"];
                                $sn = 1;
                                $sql = "select application.application_id,application.student_id,students.student_name,major.major_name,application.subject_id,subject.subject_name,
                                application.class_id,semester.semester_name,year.year_name,application.reasons,application.cvgd_status
                                 FROM ((((((class
                                 INNER JOIN application ON application.class_id = class.class_id)
                                 INNER JOIN subject ON subject.subject_id=application.subject_id)
                                 INNER JOIN semester ON semester.semester_id=application.semester_id)
                                 INNER JOIN year ON year.year_id = application.year_id)
                                 INNER JOIN students ON students.student_id=application.student_id)
                                 INNER JOIN major ON major.major_id=students.major_id)
                                 WHERE class.teacher_id='$teacher_id' ORDER BY application.application_id DESC";

                                $result = mysqli_query($conn, $sql);
                                ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="table-Warning" style="background-color: #d7dee4;">
                                            <!-- <th scope="col">Mã Đơn</th> -->
                                            <th scope="col">STT</th>
                                            <th scope="col">Mã Đơn</th>
                                            <th scope="col">Mã Sinh Viên</th>
                                            <th scope="col">Tên Sinh Viên</th>
                                            <th scope="col">Tên Ngành</th>
                                            <th scope="col">Mã Học Phần</th>
                                            <th scope="col">Tên Học Phần</th>
                                            <th scope="col">Mã Lớp</th>
                                            <th scope="col">Học Kỳ</th>
                                            <th scope="col">Năm Học</th>
                                            <th scope="col">Lý Do</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Tác Vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $sn++ ?></td>
                                                    <td><?php echo $row['application_id'] ?></td>
                                                    <td><?php echo $row['student_id'] ?>
                                                        <!-- <button id='<?php echo $row['student_id'] ?>' class="bi bi-eye" type="button" style="border:0px;font-size:20px" data-bs-toggle="modal" data-bs-target="#ModalThongTinSV"></button> -->
                                                    </td>
                                                    <td><?php echo $row['student_name'] ?>
                                                    </td>
                                                    <td><?php echo $row['major_name'] ?></td>
                                                    <td><?php echo $row['subject_id'] ?></td>
                                                    <td><?php echo $row['subject_name'] ?></td>
                                                    <td><?php echo $row['class_id'] ?></td>
                                                    <td><?php echo $row['semester_name'] ?></td>
                                                    <td><?php echo $row['year_name'] ?></td>
                                                    <td><?php echo $row['reasons'] ?></td>
                                                    <td>
                                                        <?php if ($row['cvgd_status'] == 0) : ?>
                                                            <span class="badge bg-warning">Chưa duyệt</span>
                                                        <?php elseif ($row['cvgd_status'] == 1) : ?>
                                                            <span class="badge bg-success">Đã duyệt</span>
                                                        <?php elseif ($row['cvgd_status'] == 2) : ?>
                                                            <span class="badge bg-danger">Đã từ chối</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="del_edit">
                                                        <!-- <button type="button"  class="bi bi-eye" style="border:0px;font-size:20px"></button> -->
                                                        <a class="bi bi-eye" href="indon.php?application_id=<?php echo $row['application_id'] ?>" role="button" style="border:0px;font-size:20px; color:black"></a>
                                                        <?php if ($row['cvgd_status'] == 0) : ?>
                                                            <a class="duyet_don" href="giangvien_duyet.php?application_id=<?php echo $row['application_id'] ?>"><button type="button" class="bi bi-check-circle" style="border:0px;font-size:20px; color:green"></button></a>
                                                            <a class="tu_choi" href="giangvien_tuchoi.php?application_id=<?php echo $row['application_id'] ?>"><button type="button" class="bi bi-x-circle" style="border:0px;font-size:20px; color:red"></button></a>
                                                        <?php else : ?>
                                                        <?php endif; ?>
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
                    </div>

            </div>
        </div>
    </div>
    <!-- Modal Thông Tin Cá Nhân -->
    <div class="modal fade" id="ModalThongTinSV" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content bg-modal">
                <div class="modal-header" style="background: #06bee1;">
                    <h5 class="modal-title" id="exampleModalLabel">Thông Tin Sinh Viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-info">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã Sinh Viên:</th>
                                        <td><span id="student_id_modal"></span></td>
                                    </tr>
                                    <!-- <tr>
                                                <th scope="col">Họ Tên Sinh Viên:</th>
                                                <td><?php echo $row['student_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Ngày Sinh:</th>
                                                <td><?php echo date('d/m/Y', strtotime($row['student_birthday'])) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Giới Tính:</th>
                                                <td><?php echo $row['sex_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Địa Chỉ:</th>
                                                <td><?php echo $row['student_birthplace'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Số Điện Thoại:</th>
                                                <td><?php echo $row['student_phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Mã Lớp:</th>
                                                <td><?php echo $row['student_class_id'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Khóa:</th>
                                                <td><?php echo $row['course_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Năm Học:</th>
                                                <td><?php echo $row['academicyear_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Tên Ngành:</th>
                                                <td><?php echo $row['major_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Thuộc Khoa:</th>
                                                <td><?php echo $row['faculty_name'] ?></td>
                                            </tr> -->
                                </thead>
                            </table>
                            <div class="form-group">
                                <span>mã số sinh viên</span>
                                <input type="text" id="student_id_modal">
                            </div>
                        </div>
                        <?php
                        //     }
                        // } else {
                        //     echo "Chưa có dữ liệu";
                        // }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <script>
        $(document).ready(function() {
            $('button').click(function() {
                svid = $(this).attr('student_id')
                $.ajax({
                    url: "demo_test.txt",
                    success: function(result) {
                        $("#div1").html(result);
                    }
                });

                $('#ModalThongTinSV').show();
            });
        });
    </script>
    <!-- <div class="col-md-1"> -->

    </div>
    <!-- end-main-content -->
    <?php
    //footer
    include "../Sinhvien/footer.html";
    //modal
    include('modal.php')
    ?>
    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>


    <!--duyet don  -->
    <script>
        $('.duyet_don').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            console.log(self.data('title'));
            Swal.fire({
                title: 'Bạn có chắc muốn duyệt đơn này?',
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
        const flashdata = $('.flash-data').data('flashdata')
        if (flashdata) {
            Swal.fire(
                'Đã duyệt!',
                'Đơn đã được chuyển đến trưởng bộ môn.',
                'success'
            )
        }
    </script>
    <!-- end duyet don -->

    <!-- tu choi don -->
    <script>
        $('.tu_choi').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            console.log(self.data('title'));
            Swal.fire({
                title: 'Bạn có chắc muốn từ chối đơn này?',
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
        const flashdata = $('.flash-data').data('flashdata')
        if (flashdata) {
            Swal.fire(
                'Đã từ chối!',
                'Đơn này đã bị từ chối.',
                'success'
            )
        }
    </script>

    <!-- end tu choi don -->
</body>

</html>