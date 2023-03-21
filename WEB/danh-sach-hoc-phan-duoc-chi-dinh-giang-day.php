<?php
    $sql1 = "SELECT TRAINING_INSTITUTE_NAME FROM PROFILE AS P INNER JOIN TRAINING_INSTITUTE AS TI ON P.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN TRAINING_MAJORS AS TM ON TI.TRAINING_INSTITUTE_CODE = TM.TRAINING_INSTITUTE_CODE WHERE P.USER_ID = {$user_id}";
    $training_institute = getOne($connect, $sql1);

    $sql3 = "SELECT C.ID as classroom_id, C.CLASSROOM_NAME as classroom_name, C.ROOM_CODE as room_code, C.START_TIME as start_time, C.END_TIME as end_time, C.NUM_OF_STUDENT_MAX as num_of_student_max, S.STUDENT_ID as student_id, " .
            "SJ.SUBJECT_CODE AS subject_code, SJ.SUBJECT_NAME AS subject_name, SJ.NUM_OF_CREDIT AS num_of_credit " .
            "FROM TEACHING AS T INNER JOIN CLASSROOM AS C ON T.ID = C.TEACHING_ID INNER JOIN STUDYING AS S ON C.ID = S.CLASSROOM_ID INNER JOIN SUBJECT AS SJ ON S.SUBJECT_CODE = SJ.SUBJECT_CODE WHERE T.LECTURER_ID = {$user_id}";
    $list_subject_info = getAll($connect, $sql3);

    if ($training_institute == false) {
        $training_institute = array(
            'TRAINING_INSTITUTE_NAME' => 'Không có dữ liệu'
        );
    }

    $data_filer = array();
    foreach ($list_subject_info as $item) {
        $key = $item['classroom_id'];
        if (isset($data_filer[$key]) == false) {
            $data_filer[$key] = array(
                'classroom_name' => $item['classroom_name'],
                'room_code' => $item['room_code'],
                'start_time' => $item['start_time'],
                'end_time' => $item['end_time'],
                'num_of_student_max' => $item['num_of_student_max'],
                'subject_code' => $item['subject_code'],
                'subject_name' => $item['subject_name'],
                'num_of_credit' => $item['num_of_credit'],
                'student_id' => array($item['student_id'])
            );
        } else {
            $data_filer[$key]['student_id'][] = $item['student_id'];
        }
    }
?>

<h2 class=" mt-2 text-info">Danh sách các học phần được chỉ định giảng dạy</h2>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 pl-0">
            <p class="mb-1">Viện đào tạo: <b><?= $training_institute['TRAINING_INSTITUTE_NAME']?></b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 pl-0">
<!--            <span class="text-danger"><i>--><?//= $err_msg?><!--</i></span>-->
        </div>
    </div>
</div>
<div class="table-responsive mt-2">
    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center" style="width: 1%;">STT</th>
                <th class="text-center" style="width: 3%;">Mã học phần</th>
                <th class="" style="width: 7%;">Tên học phần</th>
                <th class="text-center" style="width: 3%;">Số TC</th>
                <th class="text-center" style="width: 3%;">Lớp</th>
                <th class="text-center" style="width: 3%;">Phòng</th>
                <th class="text-center" style="width: 3%;">Thời gian bắt đầu</th>
                <th class="text-center" style="width: 3%;">Thời gian kết thúc</th>
                <th class="text-center" style="width: 3%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stt = 1;
        foreach ($data_filer as $classroom_id => $data) {
            ?>
            <tr>
                <td class="text-center"><?= $stt?></td>
                <td class="text-center"><?= $data['subject_code']?></td>
                <td class=""><?= $data['subject_name']?></td>
                <td class="text-center"><?= $data['num_of_credit']?></td>
                <td class="text-center"><?= $data['classroom_name']?></td>
                <td class="text-center"><?= $data['room_code']?></td>
                <td class="text-center"><?= $data['start_time']?></td>
                <td class="text-center"><?= $data['end_time']?></td>
                <td class="text-center">
                    <a href="?r=danh-sach-sinh-vien-thuoc-lop&classroom_id=<?= $classroom_id?>&subject_code=<?= $data['subject_code']?>" class="btn btn-sm btn-success">Xem</a>
                </td>
            </tr>
        <?php
            $stt++;
        }
        ?>
        </tbody>
    </table>
</div>
<a href="?r=trang-chu" class="btn btn-secondary">Trở về</a>