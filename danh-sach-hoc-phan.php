<?php
    $sql1 = "SELECT TRAINING_INSTITUTE_NAME, TRAINING_MAJORS_NAME FROM PROFILE AS P INNER JOIN TRAINING_INSTITUTE AS TI ON P.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN TRAINING_MAJORS AS TM ON TI.TRAINING_INSTITUTE_CODE = TM.TRAINING_INSTITUTE_CODE WHERE P.USER_ID = {$user_id}";
    $training_institute = getOne($connect, $sql1);

    $sql2 = "SELECT TRAINING_SYSTEM_NAME FROM TRAINING_SYSTEM AS TS INNER JOIN TRAINING_MAJORS AS TM ON TS.TRAINING_SYSTEM_CODE = TM.TRAINING_SYSTEM_CODE " .
            "INNER JOIN TRAINING_INSTITUTE AS TI ON TM.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN PROFILE AS P ON TI.TRAINING_INSTITUTE_CODE = P.TRAINING_INSTITUTE_CODE WHERE P.USER_ID = {$user_id}";
    $training_system = getOne($connect, $sql2);

    $sql3 = "SELECT * FROM SUBJECT AS S INNER JOIN TRAINING_MAJORS AS TM ON S.TRAINING_MAJORS_CODE = TM.TRAINING_MAJORS_CODE WHERE TM.TRAINING_INSTITUTE_CODE = (SELECT TRAINING_INSTITUTE_CODE FROM PROFILE WHERE USER_ID = {$user_id}) " .
            "AND S.SUBJECT_CODE IN (SELECT SUBJECT_CODE FROM TEACHING WHERE STATUS ='inprogress')";
    $list_subject = getAll($connect, $sql3);

    if ($training_institute == false) {
        $training_institute = array(
            'TRAINING_INSTITUTE_NAME' => 'Không có dữ liệu',
            'TRAINING_MAJORS_NAME' => 'Không có dữ liệu'
        );
    }

    if ($training_system == false) {
        $training_system = array(
            'TRAINING_SYSTEM_NAME' => 'Không có dữ liệu'
        );
    }
?>

<h2 class=" mt-2 text-info">Danh sách các học phần trong kỳ này</h2>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 pl-0">
            <p class="mb-1">Viện đào tạo: <b><?= $training_institute['TRAINING_INSTITUTE_NAME']?></b></p>
            <p class="mb-1">Ngành học: <b><i><?= $training_institute['TRAINING_MAJORS_NAME']?></i></b></p>
            <p class="mb-1">Hệ thống đào tạo: <b><?= $training_system['TRAINING_SYSTEM_NAME']?></b></p>
            <i class="text-danger">Sinh viên chỉ được phép đăng ký các học phần mà đã được chỉ định giảng viên giảng dạy và đã được xếp lớp</i>
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
                <th class="text-center" style="width: 3%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stt = 1;
        foreach ($list_subject as $subject) {
            ?>
            <tr>
                <td class="text-center"><?= $stt?></td>
                <td class="text-center"><?= $subject['subject_code']?></td>
                <td class=""><?= $subject['subject_name']?></td>
                <td class="text-center"><?= $subject['num_of_credit']?></td>
                <td class="text-center">
                    <a href="<?= '?r=dang-ky-hoc-phan&subject_code=' . $subject['subject_code']?>" class="btn btn-sm btn-success">Đăng ký</a>
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