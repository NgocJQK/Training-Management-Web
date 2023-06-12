<?php
    $subject_code = isset($_GET['subject_code']) == true ? $_GET['subject_code'] : '';
    $sq11 = "SELECT * FROM SUBJECT WHERE SUBJECT_CODE = '{$subject_code}'";
    $subject_info = getOne($connect, $sq11);

    $sql2 = "SELECT C.ID AS classroom_id, C.ROOM_CODE AS room_code, C.CLASSROOM_NAME AS classroom_name, C.NUM_OF_STUDENT_MAX AS num_of_student_max, U.FULLNAME AS fullname FROM CLASSROOM AS C INNER JOIN TEACHING AS T ON C.TEACHING_ID = T.ID INNER JOIN USER AS U ON T.LECTURER_ID = U.ID WHERE T.SUBJECT_CODE = '{$subject_code}'";
    $class_info = getOne($connect, $sql2);

    $sql3 = "SELECT COUNT(*) AS NUM FROM STUDYING WHERE SUBJECT_CODE = '{$subject_code}' AND STATUS = 'register'";
    $num_student_register = getOne($connect, $sql3);


    $check_regited = false;
    $err_msg = '';
    $sql_check = "SELECT COUNT(*) AS COUNT FROM STUDYING WHERE STUDENT_ID = '{$user_id}' AND SUBJECT_CODE = '{$subject_code}'";
    $data_check = getOne($connect, $sql_check);

    if ((int)$data_check['COUNT'] > 0) {
        $check_regited = true;
        $err_msg = 'Bạn đã đăng ký học phần này rồi !';
    }
    $check = true;
    $msg = '';

    if ($class_info == false) {
        $check = false;
        $msg = "Môn học này chưa được xếp lớp !";
        $class_info['room_code'] =  '';
        $class_info['classroom_name'] =  '';
        $class_info['num_of_student_max'] =  '';
        $class_info['fullname'] =  '';
    }

    if (isset($_POST['save']) == true) {
        $sql = "INSERT INTO STUDYING (STUDENT_ID, SUBJECT_CODE, CLASSROOM_ID) VALUES(?, ?, ?)";
        $subject_code = isset($_POST['subject_code']) == true ? $_POST['subject_code'] : '';
        $classroom_id = isset($_POST['classroom_id']) == true ? $_POST['classroom_id'] : '';
        $data = array(
            $user_id,
            $subject_code,
            $classroom_id
        );
        $result = insert($connect, $sql, $data);
        if ($result == true) {
            header("Location: ?r=danh-sach-hoc-phan");
        }
    }
?>

<h2 class=" mt-2 text-info">Đăng ký học phần</h2>
<hr>
<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-sm-3 pl-0">
            <p class="mb-1">Mã học phần: <b><?= $subject_info['subject_code']?></b></p>
            <p class="mb-1">Tên học phần: <b><i><?= $subject_info['subject_name']?></i></b></p>
            <p class="mb-1">Số tín chỉ: <b><?= $subject_info['num_of_credit']?></b></p>
            <p class="mb-1">Số sinh viên tối đa: <b><?= $class_info['num_of_student_max']?></b></p>
        </div>
        <div class="col-sm-3 pl-0">
            <p class="mb-1">Phòng học: <b><?= $class_info['room_code']?></b></p>
            <p class="mb-1">Tên lớp: <b><i><?= $class_info['classroom_name']?></i></b></p>
            <p class="mb-1">Giảng viên: <b><?= $class_info['fullname']?></b></p>
            <p class="mb-1">Số sinh viên hiện tại: <b><?= $num_student_register['NUM']?></b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 pl-0">
            <span class="text-danger"><i><?= $msg?></i></span>
            <span class="text-danger"><i><?= $err_msg?></i></span>
        </div>
    </div>
</div>
<form action="#" method="POST">
    <button type="submit" class="btn btn-primary" name="save" <?= $check == false || $check_regited == true ? "disabled" : ''?>>Xác nhận đăng ký học phần này</button>
    <input type="hidden" name="subject_code" value="<?= $subject_info['subject_code']?>">
    <input type="hidden" name="classroom_id" value="<?= $class_info['classroom_id']?>">
    <a href="?r=danh-sach-hoc-phan" class="btn btn-secondary">Trở về</a>
</form>