<?php
    $classroom_id = isset($_GET['classroom_id']) == true ? $_GET['classroom_id'] : '';
    $subject_code = isset($_GET['subject_code']) == true ? $_GET['subject_code'] : '';

    $sql1 = "SELECT FULLNAME AS fullname, DOB AS dob, PHONE_NUMBER AS phone_number, EMAIL AS email, USERNAME AS username, USER_CODE AS user_code, ".
            " ADDRESS as address, U.STATUS as status, S.ID AS study_id, S.STUDENT_ID AS student_id " .
            "FROM STUDYING AS S INNER JOIN USER AS U ON S.STUDENT_ID = U.ID WHERE S.CLASSROOM_ID = '{$classroom_id}'";
    $list_student = getAll($connect, $sql1);

    $sql2 = "SELECT CLASSROOM_NAME FROM CLASSROOM WHERE ID = {$classroom_id}";
    $classroom_name = getOne($connect, $sql2);

?>
<h2 class="mt-2 text-success">Danh sách sinh viên thuộc lớp <i>"<?= $classroom_name['CLASSROOM_NAME']?>"</i></h2>
<hr>
<div class="table-responsive mt-2">
    <table class="table table-striped table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center" style="width: 3%;">#</th>
                <th style="width: 12%;">Họ và tên</th>
                <th class="text-center" style="width: 7%;">Ngày sinh</th>
                <th class="text-center" style="width: 6%;">SĐT</th>
                <th class="text-center" style="width: 6%;">Email</th>
                <th class="text-center" style="width: 8%;">Tên tài khoản</th>
                <th class="text-center" style="width: 8%;">Mã sinh viên</th>
                <th>Địa chỉ</th>
                <th class="text-center" style="width: 6%;">Trạng thái</th>
                <th class="text-center" style="width: 8%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stt = 1;
            foreach ($list_student as $student) {
        ?>
            <tr>
                <td class="text-center"><?= $stt?></td>
                <td><?= $student['fullname']?></td>
                <td class="text-center"><?= $student['dob']?></td>
                <td class="text-center"><?= $student['phone_number']?></td>
                <td class="text-center"><?= $student['email']?></td>
                <td class="text-center"><?= $student['username']?></td>
                <td class="text-center"><?= $student['user_code']?></td>
                <td><?= $student['address']?></td>
                <td class="text-center"><?= ucfirst($student['status'])?></td>
                <td class="text-center">
                    <a href="<?= '?r=nhap-diem&&classroom_id=' .$classroom_id.'&student_id=' . $student['student_id'] . '&subject_code=' . $subject_code . '&study_id=' . $student['study_id']?>" class="btn btn-sm btn-info">Nhập điểm</a>
                </td>
            </tr>
        <?php
            $stt++;
            }
            ?>
        </tbody>
    </table>
</div>
<a href="?r=hoc-phan-chi-dinh-giang-day" class="btn btn-secondary">Trở về</a>