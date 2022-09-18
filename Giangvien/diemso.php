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
            min-height: 60vh;
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
                        <a class="navbar-brand" href="index_GiangVien.php" style="font-family: 'Maven Pro', sans-serif;font-size:25px;color:#fff;margin-right:0">
                            <img src="../css/image/bg.png" alt="" width="60" height="60" class="d-inline-block">
                            Hệ Thống Xin Vắng Thi CTU
                        </a>
                        <form class="d-flex" action="timkiem_diem_giangvien.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Nhập tên sinh viên..." name="search" aria-label="Search" required style="width: 500px;">
                            <button class="btn btn-light" style="color: #06bee1;" type="submit" name="submit">Tìm kiếm</button>
                        </form>
                        <div class="box" style="margin-right: 30px;">
                            <div class="home-btn">
                                <a href="index_GiangVien.php" style="text-decoration: none;"><button type="button" class="icon-button">
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
                            <h3 style="text-align: center;">Cập Nhật Điểm Cho Sinh Viên</h3>
                            <?php
                            $teacher_id = $_SESSION["acc_student_id"];
                            $sn = 1;
                            $sql = "SELECT application.application_id, application.student_id,students.student_name,major.major_name,application.subject_id,subject.subject_name,application.class_id,semester.semester_name,year.year_name,diem.diem_name,diem.thoigian
                            FROM (((((((diem
                                  INNER JOIN application ON application.application_id=diem.application_id)
                                   INNER JOIN semester ON semester.semester_id=diem.semester_id)
                                  INNER JOIN year ON year.year_id=diem.year_id)
                                  INNER JOIN students ON students.student_id=application.student_id)
                                  INNER JOIN subject ON subject.subject_id=application.subject_id)
                                   INNER JOIN major ON major.major_id=students.major_id)
                                  INNER JOIN class ON class.class_id=application.class_id)
                                 WHERE class.teacher_id='$teacher_id' ORDER BY application.application_id DESC";

                            $result = mysqli_query($conn, $sql);
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã Sinh Viên</th>
                                        <th scope="col">Tên Sinh Viên</th>
                                        <th scope="col">Tên Ngành</th>
                                        <th scope="col">Mã Học Phần</th>
                                        <th scope="col">Tên Học Phần</th>
                                        <th scope="col">Mã Lớp</th>                                 
                                        <th scope="col">Điểm Số</th>
                                        <th scope="col">Ngày Cập Nhật</th>
                                        <th scope="col">Học Kỳ Cập Nhật</th>
                                        <th scope="col">Năm Học Cập Nhật</th>
                                        <th scope="col">Tác Vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $sn++ ?></td>
                                                <td><?php echo $row['student_id'] ?></td>
                                                <td><?php echo $row['student_name'] ?></td>
                                                <td><?php echo $row['major_name'] ?></td>
                                                <td><?php echo $row['subject_id'] ?></td>
                                                <td><?php echo $row['subject_name'] ?></td>
                                                <td><?php echo $row['class_id'] ?></td>                                                                   
                                                <td><?php echo $row['diem_name'] ?></td>  
                                                <td><?php echo date('d-m-Y', strtotime($row['thoigian']))?></td>      
                                                <td><?php echo $row['semester_name'] ?></td>
                                                <td><?php echo $row['year_name'] ?></td>                                               
                                              
                                                <td class="del_edit">
                                                    <a href="suadiem.php?application_id=<?php echo $row['application_id'] ?>"><button type="button" class="bi bi-pencil-square" style="border:0px;font-size:20px"></button></a>
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
    
    <!-- end duyet don -->
    <!-- tu choi don -->
   
    <!-- end tu choi don -->
</body>

</html>