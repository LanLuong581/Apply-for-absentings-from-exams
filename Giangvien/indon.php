<?php
include('../Config/constants.php');
session_start();
if (!isset($_SESSION['acc_account_type'])) {
    header("location:../templates/login.php");
} 


$application_id = $_GET['application_id'];
$sql = "select students.student_name,students.student_id,students.student_birthday,students.student_birthplace,major.major_name,course.course_name,
RIGHT(students.student_class_id,2) as mslop,students.student_class_id,students.student_phone,application.subject_id,application.class_id,subject.subject_name,
semester.semester_name,year.year_name,application.reasons,DAY(application.date),MONTH(application.date),YEAR(application.date)
from ((((((application
               INNER JOIN students on application.student_id=students.student_id)
      INNER JOIN major ON students.major_id=major.major_id)
      INNER JOIN course ON course.course_id=students.course_id)
      INNER JOIN subject ON subject.subject_id=application.subject_id)
      INNER JOIN semester ON semester.semester_id=application.semester_id)
      INNER JOIN year ON year.year_id=application.year_id)
               WHERE application_id='$application_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
// var_dump($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/vendor/paper-css/paper.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <title>Hệ Thống Xin Điểm I</title>
    <style>
        @page {
            size: A4
        }
    </style>
</head>

<body class="A4">
    <section class="sheet padding-20mm">
        <h4 style="text-align:center">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br><u>Độc lập-Tự do-Hạnh phúc</u> </h4><br>
        <h3 style="text-align:center">ĐƠN XIN PHÉP VẮNG THI KẾT THÚC HỌC PHẦN (ĐIỂM I)</h3>
        <p style="font-size: 18px;">&emsp; Kính gửi:&emsp; - Ban chủ nhiệm Khoa Công Nghệ Thông Tin Và Truyền Thông <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;- Qúy thầy/cô giảng dạy học phần : <b><?php echo $row['subject_name'] ?></b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;- Bộ Môn : <b><?php echo $row['major_name'] ?></b> <br>
            Tôi Tên : <b><?php echo $row['student_name'] ?></b> &emsp; Mã số sinh viên : <b><?php echo $row['student_id'] ?></b> <br>
            Ngày Sinh : <b><?php echo date('d/m/Y', strtotime($row['student_birthday'])) ?></b><br>
            Hộ khẩu thường trú : <b><?php echo $row['student_birthplace'] ?></b><br>
            Hiện đang học lớp : <b><?php echo $row['major_name'] ?></b> <b><?php echo $row['course_name'] ?></b>-<b><?php echo $row['mslop'] ?></b>- Mã lớp:<b><?php echo $row['student_class_id'] ?></b> <br>
            Điện Thoại : <b><?php echo $row['student_phone'] ?> </b><br>
            Hệ đào tạo : Dài hạn tập trung (chính qui) tại trường Đại học Cần Thơ. <br>
            </p>
            <hr>
            <p style="font-size: 18px;text-align:justify">
            &emsp;Nay tôi làm đơn này gởi đến Ban Chủ nhiệm Khoa, Bộ môn và quý Thầy/Cô giảng dạy học phần: Mã số HP: <b><?php echo $row['subject_id'] ?></b>,
            Nhóm/ lớp HP: <b><?php echo $row['class_id'] ?></b> tên HP: <b><?php echo $row['subject_name'] ?></b> cho phép tôi không thi kết thúc học phần
            và được bảo lưu kết quả đánh giá giữa kỳ nhận điểm I cho học phần này trong học kỳ <b><?php echo $row['semester_name'] ?></b>, năm học: <b><?php echo $row['year_name'] ?></b> .
            Trong thời hạn 1 năm tiếp theo, tôi sẽ dự thi để hoàn tất điểm học phần. Nếu quá thời hạn trên, tôi không hoàn tất điểm học phần này thì điểm I sẽ được chuyển thành điểm F. <br>
            Lý do vắng thi: <b><?php echo $row['reasons'] ?></b><br>
            <i>(đính kèm giấy xác nhận minh chứng lý do).</i> <br> 
        </p>
          
            <hr>
            <p style="font-size: 18px;">
            Kính mong được sự chấp thuận của quý thầy/cô. <br>
            Chân thành cảm ơn và kính chào trân trọng.
        </p>
           
       

        <br>
        <table style="width:100%">
            <tr>
                <td style="width:200px;"><b>Ý kiến CBGD</b></td>
                <td style="width:170px;"><b>Bộ Môn</b></td>
                <td><i>Cần Thơ, ngày <?php echo $row['DAY(application.date)']?> Tháng <?php echo $row['MONTH(application.date)']?> Năm <?php echo $row['YEAR(application.date)'];?></i> </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="text-align:center;"><b>Người viết đơn</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="text-align:center;">(ký tên)</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="text-align:center;">
                    <br>
                    <br>
                    <br>

                    <b><?php echo $row['student_name'] ?></b>
                </td>
            </tr>
            <tr>
            <td></td>
            <td  style="text-align:center"><b>Ban Chủ Nhiệm</b></td>
        </tr>
        </table>
        <br><br>
      
       
        <br><br><br>
        <hr>
        <p style="font-weight: 30;text-align:justify"><i>Lưu ý: Đơn sau khi được GV và Bộ môn ký xác nhận (không cần trình BCN Khoa ký), 
            SV photo giữ 1 bản, GV giữ 1 bản. Đến HK SV hoàn thành môn học này thì nộp lại đơn cho GV dạy để nhập điểm.
             GV nộp phiếu điều chỉnh điểm kèm đơn này cho giáo vụ Khoa.</i></p>
    </section>
    <button type="button" class="btn btn-primary" onclick="window.print()">in trang này</button>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
</body>

</html>