<?php
$connect = new PDO("mysql:host=localhost;dbname=webdieminln", "root", "");
include('../Config/constants.php');
include('../Config/constants.php');
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$message = '';
$student_id = '';
$student_email = '';

session_start();
if (!isset($_SESSION['acc_account_type'])) {
    header("location:../templates/login.php");
} else {
    if ($_SESSION['acc_account_type'] != 5) {
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
    <link rel="stylesheet" href="sinhvien_index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Hệ Thống Xin Vắng Thi CTU</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
    </style>
</head>

<style>
    body {
        min-height: 100vh;
    }

    #header {
        position: fixed;
        width: 100%;
        top: 0;
    }

    #main-content {
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

    #nav-bar {
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
    <div id="container">
        <!-- header -->
        <div id="header">
            <div id="nav-bar">
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
                                    <li data-bs-toggle="modal" data-bs-target="#exampleModal"><a class="dropdown-item bi bi-person"> Thông tin cá nhân</a></li>
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
        <!-- main-content -->
        <div id="main-content">
            <div class="grid" style="grid-template-columns: repeat(4, 1fr);padding-left:50px">
                <article>
                    <img src="../css/image/hdsd.svg" alt="" width="400px" height="200px">
                    <div class="text">
                        <h4>Hướng Dẫn</h4>
                        <p>Đọc kỹ hướng dẫn sử dụng nhé!</p>
                        <button data-bs-toggle="modal" data-bs-target="#HuongDanModal">Tiếp</button>
                    </div>
                </article>
                <!-- Modal -->
                <div class="modal fade " id="HuongDanModal" tabindex="-1" aria-labelledby="HuongdanLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-modal">
                            <div class="modal-header" style="background: #06bee1;">
                                <h5 class="modal-title" id="HuongdanLabel" style="font-family: 'Lobster', cursive; font-size:30px">Hướng Dẫn</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="text-align: justify;">
                                <p style="font-size: 18px;">Chào mừng bạn đến hệ thống xin vắng thi của Trường đại học Cần Thơ <br>
                                    Để xin vắng thi bạn thực hiện các bước sau: <br>
                                    <b> Bước 1: </b> Nếu đăng nhập lần đầu, bạn bắt buộc phải cập nhật thông tin cá nhân tại góc trên cùng bên phải, việc sai thông tin sau khi gửi đơn sinh viên tự chịu trách nhiệm.<br> 
                                    <b> Bước 2: </b> Tại mục <b>"Tạo Đơn"</b>, bạn điền đúng thông tin cho môn học cần xin vắng thi, kiểm tra lại và nhấn nút <b>Nộp</b>. Sau khi nộp thành công, sinh viên sẽ nhận được mail thông báo thành công <br>
                                    <b> Bước 3: </b> Xem đơn đã nộp tại mục <b>"Quản Lý Đơn"</b>, nếu đơn ở trạng thái <b>"Chưa xử lý"</b> , bạn có thể xóa hoặc sửa đơn. Nếu đơn ở trạng thái <b>"Đang xử lý"</b>, nghĩa là đơn đang trong quá trình được duyệt. Kiểm tra email để biết quá trình duyệt. Nếu đơn bị từ chối, hãy liên hệ giảng viên để biết thông tin.<br>
                                     <b> Bước 4: </b> Nếu đơn <b>"Đang xử lý"</b> hoặc <b>"Đã được duyệt"</b>, bạn không thể sửa hoặc xóa đơn, khi đó hãy liên hệ Admin để được hỗ trợ.<br>
                                      <b> Bước 5: </b>Tại mục <b>"Xem Điểm"</b>, bạn có thể xem điểm của môn đã xin I nếu giảng viên đã sửa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <article>
                    <img src="../css/image/fillform.svg" alt="" width="400px" height="200px">
                    <div class="text">
                        <h4>Tạo Đơn</h4>
                        <p>Điền những thông tin cơ bản để tự động hoàn thành đơn</p>
                        <button data-bs-toggle="modal" data-bs-target="#DienDonModal">Tiếp</button>
                    </div>
                </article>

                <!-- Modal Điền Đơn -->
                <div class="modal fade" id="DienDonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-modal">
                            <div class="modal-header" style="background: #06bee1;">
                                <h5 class="modal-title" id="exampleModalLabel" style="font-family: 'Lobster', cursive; font-size:30px">Thông Tin Đơn</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <?php
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
                            <div class="modal-body">
                                <form class="main-form" action="" method="POST">
                                    <div class="col-md-12">
                                        <div col-md-12>
                                            <div class="form-group">
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <label for="subject_id" class="form-label required">Mã Số Học Phần</label>
                                                        <select name="subject_id" id="subject_id" class="form-select" required>
                                                            <?php foreach ($subject_list as $subject_ls) : ?>
                                                                <option value="<?= $subject_ls['subject_id'] ?>"><?= $subject_ls['subject_id'] ?>-<?= $subject_ls['subject_name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="class_id" class="form-label required">Mã Lớp</label>
                                                        <select name="class_id" id="class_id" class="form-select" required>
                                                            <?php foreach ($class_list as $class_ls) : ?>
                                                                <option value="<?= $class_ls['class_id'] ?>"><?= $class_ls['class_id'] ?></option>
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
                                                                <option value="<?= $semester_ls['semester_id'] ?>"><?= $semester_ls['semester_name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="year_id" class="form-label required">Năm Học</label>
                                                        <select name="year_id" id="year_id" class="form-select" required>
                                                            <?php foreach ($year_list as $year_ls) : ?>
                                                                <option value="<?= $year_ls['year_id'] ?>"><?= $year_ls['year_name'] ?></option>
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
                                                            <textarea class="form-control" id="reasons" name="reasons" rows="3" placeholder="Lý Do" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="application_submit" id="application_submit" class="btn btn-primary" value="Nộp Đơn">
                                    </div>
                                </form>
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
                        <a href="quanlydon.php?student_id=<?php echo $_SESSION["acc_student_id"]; ?>"><button>Tiếp</button></a>
                    </div>
                </article>

                <article>
                    <img src="../css/image/point.svg" alt="" width="400px" height="200px">
                    <div class="text">
                        <h4>Xem Điểm</h4>
                        <p>Xem điểm đã được giảng viên sửa</p>
                        <a href="xemdiem.php?student_id=<?php echo $_SESSION["acc_student_id"]; ?>"><button>Tiếp</button></a>
                    </div>
                </article>

            </div>

        </div>
        <div class="slider">
            <div class="swiper mySwiper pb-5">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img class="avatar" src="../css/image/slide1.jpg" alt=""></div>
                    <div class="swiper-slide"><img class="avatar" src="../css/image/slide2.jpg" alt=""></div>
                    <div class="swiper-slide"><img class="avatar" src="../css/image/slide3.jpg" alt=""></div>
                    <div class="swiper-slide"><img class="avatar" src="../css/image/slide4.jpg" alt=""></div>
                    <div class="swiper-slide"><img class="avatar" src="../css/image/slide5.jpg" alt=""></div>
                    <div class="swiper-slide"><img class="avatar" src="../css/image/slide6.jpg" alt=""></div>
                    <div class="swiper-slide"><img class="avatar" src="../css/image/slide7.jpg" alt=""></div>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    slidesPerGroup: 4,
                    loop: true,
                    centeredSlides: true,
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            </script>
        </div>
        <!-- end main-conten -->
        <!-- footer -->
        <?php include "./footer.html" ?>

        <!-- end footer -->
    </div>

    <!-- Modal Thông Tin Cá Nhân -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            $sql = "SELECT students.student_name,students.student_birthday,students.student_class_id,sex.sex_name,students.student_birthplace,students.student_phone,course.course_name,academic_year.academicyear_name,major.major_name,faculty.faculty_name
                            FROM (((((students
                            INNER JOIN faculty ON students.faculty_id = faculty.faculty_id)
                            INNER JOIN major ON students.major_id = major.major_id)
                            INNER JOIN sex ON students.sex_id = sex.sex_id)
                            INNER JOIN course ON students.course_id = course.course_id)
                            INNER JOIN academic_year ON students.academicyear_id = academic_year.academicyear_id)
                            WHERE students.student_id='$student_id';";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
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
    $sql_edit = "SELECT*FROM students WHERE student_id= '$student_id' ";
    $result_students = mysqli_query($conn, $sql_edit);
    $data = mysqli_fetch_array($result_students, MYSQLI_ASSOC);

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

    $sql_course = "SELECT * FROM course;";
    $result_course = mysqli_query($conn, $sql_course);
    $course_list = [];
    while ($row = mysqli_fetch_array($result_course, MYSQLI_ASSOC)) {
        $course_list[] = [
            'course_id' => $row['course_id'],
            'course_name' => $row['course_name'],
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

    $sql_academicyear = "SELECT * FROM academic_year;";
    $result_academicyear = mysqli_query($conn, $sql_academicyear);
    $academicyear_list = [];
    while ($row = mysqli_fetch_array($result_academicyear, MYSQLI_ASSOC)) {
        $academicyear_list[] = [
            'academicyear_id' => $row['academicyear_id'],
            'academicyear_name' => $row['academicyear_name'],
        ];
    }

    ?>

    <!-- Modal Cập Nhật Thông Tin Cá Nhân -->
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
                                        <label for="student_name" class="form-label required">Họ Tên sinh viên</label>
                                        <input type="text" class="form-control" name="student_name" id="student_name" value="<?= $data['student_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_sex" class="form-label required">Giới Tính</label>
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
                                        <label for="student_birthday" class="form-label required">Ngày Sinh</label>
                                        <input type="date" class="form-control" name="student_birthday" id="student_birthday" value="<?= $data['student_birthday']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_birthplace" class="form-label required">Địa Chỉ</label>
                                        <input type="text" class="form-control" name="student_birthplace" id="student_birthplace" value="<?= $data['student_birthplace']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_phone" class="form-label required">Số Điện Thoại</label>
                                        <input type="text" class="form-control" name="student_phone" id="student_phone" value="<?= $data['student_phone']; ?>">
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

                            <div class="row">
                                <div class="form-group">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label for="major_id" class="form-label required">Ngành</label>
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
                                        <div class="col-md-6">
                                            <label for="Class_ID" class="form-label required">Mã Lớp</label>
                                            <input type="text" class="form-control" name="student_class_id" id="student_class_id" value="<?= $data['student_class_id']; ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_course" class="form-label required">Khóa</label>
                                        <select name="course_id" id="course_id" class="form-select" required>
                                            <?php foreach ($course_list as $clist) : ?>
                                                <?php
                                                $course_selected = '';
                                                $course_edit = $data['course_id'];
                                                if ($clist['course_id'] == $course_edit) {
                                                    $course_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $clist['course_id'] ?>" <?= $course_selected ?>><?= $clist['course_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_acadamicyear" class="form-label required">Năm Học</label>
                                        <select name="academicyear_id" id="academicyear_id" class="form-select" required>
                                            <?php foreach ($academicyear_list as $alist) : ?>
                                                <?php
                                                $academicyear_selected = '';
                                                $academicyear_edit = $data['academicyear_id'];
                                                if ($alist['academicyear_id'] == $academicyear_edit) {
                                                    $academicyear_selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $alist['academicyear_id'] ?>" <?= $academicyear_selected ?>><?= $alist['academicyear_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <input type="submit" name="submit_update" id="submit_update" class="btn btn-primary" value="Cập Nhật">
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>

<?php
// CẬP NHẬT THÔNG TIN CÁ NHÂN
$student_id = $_SESSION["acc_student_id"];
if (isset($_POST["submit_update"])) {
    $student_name = $_POST['student_name'];
    $sex_id = $_POST['sex_id'];
    $student_birthday = $_POST['student_birthday'];
    $student_birthplace = $_POST['student_birthplace'];
    $student_phone = $_POST['student_phone'];
    $faculty_id = $_POST['faculty_id'];
    $major_id = $_POST['major_id'];
    $student_class_id = $_POST['student_class_id'];
    $course_id = $_POST['course_id'];
    $academicyear_id = $_POST['academicyear_id'];
    $sql = "UPDATE `students` SET `student_name`='$student_name',`student_class_id`='$student_class_id',`major_id`='$major_id',`faculty_id`='$faculty_id',`sex_id`='$sex_id',
    `student_birthday`='$student_birthday',`student_birthplace`='$student_birthplace',`student_phone`='$student_phone',`course_id`='$course_id',`academicyear_id`='$academicyear_id' 
    WHERE `student_id`='$student_id'";
    if (mysqli_query($conn, $sql)) {
?>
        <div class="flash-data" data-flashdata=1></div>
        <script>
            const flashdata = $('.flash-data').data('flashdata')
            if (flashdata) {
                Swal.fire(
                    'Thành công.',
                    'Đã cập nhật thông tin sinh viên',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'index_Sinhvien.php';
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

// NỘP ĐƠN
$student_id = $_SESSION["acc_student_id"];
if (isset($_POST["application_submit"])) {
    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $semester_id = $_POST['semester_id'];
    $year_id = $_POST['year_id'];
    $reasons = $_POST['reasons'];

    $sql_email_sv = "SELECT student_email FROM `account` WHERE student_id='$student_id'";
    $result = mysqli_query($conn, $sql_email_sv);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $student_email = $row['student_email'];
    }

    $data = array(
        ':student_email'   =>  $student_email,
    );
    $sql_application = "INSERT INTO `application`(`class_id`, `student_id`, `subject_id`, `semester_id`, `year_id`, `reasons`, `date`, `cvgd_status`, `bm_status`, `tk_status`) 
    VALUES ('$class_id ','$student_id','$subject_id','$semester_id','$year_id','$reasons',SYSDATE(),'0','0','0')";
    if ($statement = $connect->prepare($sql_application)) {
        $statement->execute($data);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "thanhlan581@gmail.com";
        $mail->Password = "aulp lcnw abty txzs";
        $mail->Subject = "Hệ Thống Xin Điểm I CTU Thông Báo Duyệt Đơn";
        $mail->setFrom("thanhlan581@gmail.com");
        $mail->Body = "Xin chào $student_email,<br>
                    Bạn đã gửi đơn xin điểm I thành công<br>
                    Theo dõi quá trình duyệt đơn tại website của chúng tôi <br>
                    Xin cám ơn!
                    ";
        $mail->addAddress($student_email);
        $mail->isHTML(true);
        if ($mail->send()) {
        ?>
            <div class="flash-data" data-flashdata=1></div>
            <script>
                const flashdata = $('.flash-data').data('flashdata')
                if (flashdata) {
                    Swal.fire(
                        'Thành công.',
                        'Đã nộp đơn xin vắng thi',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.href = 'quanlydon.php?m=1';
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
                        text: 'Chưa nộp đơn xin vắng thi'
                    })
                }
            </script>
<?php
        }
        // $mail->smtpClose('');
        // end gửi mail xác nhận nộp đơn thành công
        // // tìm đơn có mã lớn nhất
        $sql_application_id = "SELECT MAX(application_id) FROM application";
        $result_application_id = mysqli_query($conn, $sql_application_id);
        if (mysqli_num_rows($result_application_id) > 0) {
            $row = mysqli_fetch_assoc($result_application_id);
            $application_id = $row['MAX(application_id)'];
        }
        // tìm email giảng viên
        $sql_email_teacher = "SELECT application.application_id,class.class_id,class.teacher_id,account.student_email
            FROM (( application
                  INNER JOIN class ON class.class_id=application.class_id)
                 INNER JOIN account ON account.student_id=class.teacher_id)
                  WHERE application.application_id='$application_id'";
        $result_email_teacher = mysqli_query($conn, $sql_email_teacher);
        if (mysqli_num_rows($result_email_teacher) > 0) {
            $dong = mysqli_fetch_assoc($result_email_teacher);
            $teacher_email = $dong['student_email'];
        }

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "thanhlan581@gmail.com";
        $mail->Password = "aulp lcnw abty txzs";
        $mail->Subject = "Hệ Thống Xin Điểm I CTU Thông Báo Duyệt Đơn";
        $mail->setFrom("thanhlan581@gmail.com");
        $mail->Body = "Xin chào $teacher_email,<br>
Bạn có đơn xin điểm I cần duyệt<br>
Tiến hành duyệt đơn tại website của chúng tôi<br>
Xin cám ơn!
";
        $mail->addAddress($teacher_email);
        $mail->isHTML(true);
        if ($mail->send()) {
           
        } else {
            $message = $mail->ErrorInfo;
        }

        $mail->smtpClose('');

    }
}
?>