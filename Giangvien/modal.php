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