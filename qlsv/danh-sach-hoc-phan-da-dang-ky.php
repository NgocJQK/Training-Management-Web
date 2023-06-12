<?php
    $sql1 = "SELECT TRAINING_INSTITUTE_NAME, TRAINING_MAJORS_NAME FROM PROFILE AS P INNER JOIN TRAINING_INSTITUTE AS TI ON P.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN TRAINING_MAJORS AS TM ON TI.TRAINING_INSTITUTE_CODE = TM.TRAINING_INSTITUTE_CODE WHERE P.USER_ID = {$user_id}";
    $training_institute = getOne($connect, $sql1);

    $sql2 = "SELECT TRAINING_SYSTEM_NAME FROM TRAINING_SYSTEM AS TS INNER JOIN TRAINING_MAJORS AS TM ON TS.TRAINING_SYSTEM_CODE = TM.TRAINING_SYSTEM_CODE " .
            "INNER JOIN TRAINING_INSTITUTE AS TI ON TM.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN PROFILE AS P ON TI.TRAINING_INSTITUTE_CODE = P.TRAINING_INSTITUTE_CODE WHERE P.USER_ID = {$user_id}";
    $training_system = getOne($connect, $sql2);

    $sql3 = "SELECT * FROM SUBJECT AS S INNER JOIN STUDYING AS ST ON S.SUBJECT_CODE = ST.SUBJECT_CODE WHERE ST.STUDENT_ID = {$user_id} AND ST.STATUS = 'register'";
    $list_subject_register = getAll($connect, $sql3);


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

    $err_msg = '';
    if ($list_subject_register == false) {
        $err_msg = 'Bạn chưa đăng ký học phần nào !';
    }
?>

<h2 class=" mt-2 text-info">Danh sách các học phần đã đăng ký</h2>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 pl-0">
            <p class="mb-1">Viện đào tạo: <b><?= $training_institute['TRAINING_INSTITUTE_NAME']?></b></p>
            <p class="mb-1">Ngành học: <b><i><?= $training_institute['TRAINING_MAJORS_NAME']?></i></b></p>
            <p class="mb-1">Hệ thống đào tạo: <b><?= $training_system['TRAINING_SYSTEM_NAME']?></b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 pl-0">
            <span class="text-danger"><i><?= $err_msg?></i></span>
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
            </tr>
        </thead>
        <tbody>
        <?php
        $stt = 1;
        foreach ($list_subject_register as $subject) {
            ?>
            <tr>
                <td class="text-center"><?= $stt?></td>
                <td class="text-center"><?= $subject['subject_code']?></td>
                <td class=""><?= $subject['subject_name']?></td>
                <td class="text-center"><?= $subject['num_of_credit']?></td>
            </tr>
        <?php
            $stt++;
        }
        ?>
        </tbody>
    </table>
</div>
<a href="?r=trang-chu" class="btn btn-secondary">Trở về</a>