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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Hệ Thống Xin Vắng Thi CTU</title>
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
                        <div class="box" style="margin-right: 30px;">
                            <div class="home-btn">
                                <a href="index_SinhVien.php" style="text-decoration: none;"><button type="button" class="icon-button">
                                        <span class="material-symbols-outlined" style="font-size:30px">home</span>
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
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
                            $student_id = $_SESSION["acc_student_id"];
                            $sn = 1;
                            $sql = "SELECT application.application_id, application.subject_id,subject.subject_name,application.class_id,semester.semester_name,
                                year.year_name,application.reasons,application.cvgd_status,application.bm_status,application.tk_status
                                    FROM (((application
                                    INNER JOIN subject ON application.subject_id = subject.subject_id)
                                    INNER JOIN semester ON application.semester_id = semester.semester_id)
                                    INNER JOIN year ON application.year_id = year.year_id)
                                    WHERE application.student_id='$student_id' ORDER BY application.application_id DESC";

                            $result = mysqli_query($conn, $sql);
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã Đơn</th>
                                        <th scope="col">Mã Học Phần</th>
                                        <th scope="col">Tên Học Phần</th>
                                        <th scope="col">Mã Lớp</th>
                                        <th scope="col">Học Kỳ</th>
                                        <th scope="col">Năm Học</th>
                                        <th scope="col">Lý Do</th>
                                        <th scope="col">Trạng Thái</th>
                                        <!-- <th scope="col">Điểm Số</th> -->
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
                                                <td><?php echo $row['subject_id'] ?></td>
                                                <td><?php echo $row['subject_name'] ?></td>
                                                <td><?php echo $row['class_id'] ?></td>
                                                <td><?php echo $row['semester_name'] ?></td>
                                                <td><?php echo $row['year_name'] ?></td>
                                                <td><?php echo $row['reasons'] ?></td>
                                                <td>
                                                    <!-- neu giang vien tu choi || bo mon tu choi || truong khoa tu choi -->
                                                    <?php if ($row['cvgd_status'] == 2 || $row['bm_status'] == 2 || $row['tk_status'] == 2) : ?>
                                                        <span class="badge bg-danger">Đã từ chối</span>
                                                        <!-- neu truong khoa da duyet -->
                                                    <?php elseif ($row['tk_status'] == 1) : ?>
                                                        <span class="badge bg-success">Đã duyệt</span>
                                                        <!-- neu giang vien chua duyet-->
                                                    <?php elseif ($row['cvgd_status'] == 0 && $row['bm_status'] == 0 && $row['tk_status'] == 0) : ?>
                                                        <span class="badge bg-info">Chưa xử lý</span>
                                                        <!-- neu bo mon chua duyet -->
                                                    <?php elseif ($row['cvgd_status'] == 1 && $row['bm_status'] == 0 && $row['tk_status'] == 0) : ?>
                                                        <span class="badge bg-warning">Đang xử lý</span>
                                                        <!-- neu truong khoa chua duyet -->
                                                    <?php elseif ($row['cvgd_status'] == 1 && $row['bm_status'] == 1 && $row['tk_status'] == 0) : ?>
                                                        <span class="badge bg-warning">Đang xử lý</span>
                                                    <?php endif; ?>
                                                </td>

                                                <!-- <td><?php if($row['diem']==NULL):?>
                                                        <span class="badge bg-info">Chưa cập nhật</span>
                                                    <?php else: echo $row['diem']?>
                                                    <?php endif; ?>
                                                </td> -->

                                                <td class="del_edit">
                                                    <!-- neu truong khoa chua duyet -->
                                                    <?php if ($row['cvgd_status'] == 0 && $row['bm_status'] == 0 && $row['tk_status'] == 0) : ?>

                                                        <a href="edit_application.php?application_id=<?php echo $row['application_id'] ?>"><button type="button" class="bi bi-pencil-square" style="border:0px;font-size:20px"></button></a>
                                                        <a class="delete" href="xoadon.php?application_id=<?php echo $row['application_id'] ?>"><button type="button" class="bi bi-trash" style="border:0px;font-size:20px"></button></a>
                                                    <?php else : ?>
                                                    <?php endif; ?>
                                                    <!-- xem don -->
                                                    <a href="indon.php?application_id=<?php echo $row['application_id'] ?>"><button type="button" class="bi bi-eye" style="border:0px;font-size:20px; color:black"></button></a>

                                                    <!-- end xem don -->

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


                        <!-- <div class="col-md-1"> -->

                    </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    <div class="footer">
        <!-- footer -->
        <?php include "./footer.html" ?>

        <!-- end footer -->
    </div>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>

    <?php if (isset($_GET['m'])) : ?>
        <div class="delete" data-flashdata="<?= $_GET['m']; ?>"></div>
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
                'Thông tin đã được xóa.',
                'success'
            )
        }
    </script>
</body>

</html>

<?php
// CẬP NHẬT THÔNG TIN CÁ NHÂN
$student_id = $_SESSION["acc_student_id"];
if (isset($_POST["ediapplication_submit"])) {
    $subject_id = $_POST['subject_id'];
    $subject_name = $_POST['subject_name'];
    $class_id = $_POST['class_id'];
    $semester_id = $_POST['semester_id'];
    $year_id = $_POST['year_id'];
    $reasons = $_POST['reasons'];

    $sql = "UPDATE `application` SET `class_id`='$class_id',
    `student_id`='$student_id',`subject_id`='$subject_id',`semester_id`='$semester_id',`year_id`='$year_id',
    `reasons`='$reasons',`date`=SYSDATE(),`cvgd_status`='0',`bm_stauts`='0',`tk_status`='0' 
    WHERE aplication_id='$application_id'";
    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Đã cập nhật thông tin sinh viên')</script>";
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
