<?php
    $sql1 = "SELECT TRAINING_INSTITUTE_NAME, TRAINING_MAJORS_NAME FROM PROFILE AS P INNER JOIN TRAINING_INSTITUTE AS TI ON P.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN TRAINING_MAJORS AS TM ON TI.TRAINING_INSTITUTE_CODE = TM.TRAINING_INSTITUTE_CODE WHERE P.USER_ID = {$user_id}";
    $training_institute = getOne($connect, $sql1);

    $sql2 = "SELECT TRAINING_SYSTEM_NAME FROM TRAINING_SYSTEM AS TS INNER JOIN TRAINING_MAJORS AS TM ON TS.TRAINING_SYSTEM_CODE = TM.TRAINING_SYSTEM_CODE " .
            "INNER JOIN TRAINING_INSTITUTE AS TI ON TM.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN PROFILE AS P ON TI.TRAINING_INSTITUTE_CODE = P.TRAINING_INSTITUTE_CODE WHERE P.USER_ID = {$user_id}";
    $training_system = getOne($connect, $sql2);

    $sql3 = "SELECT S.SUBJECT_CODE, SUBJECT_NAME, NUM_OF_CREDIT, POINT_TYPE, POINT FROM SUBJECT AS S INNER JOIN STUDYING AS ST ON S.SUBJECT_CODE = ST.SUBJECT_CODE RIGHT JOIN POINT AS P ON ST.ID = P.STUDY_ID WHERE ST.STUDENT_ID = {$user_id}";
    $studying = getAll($connect, $sql3);

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

    $data_filter = array();
    foreach ($studying as $data) {
        $key = $data['SUBJECT_CODE'];
        if (isset($data_filter[$key]) == false) {
            $data_filter[$key] = array(
                'SUBJECT_CODE' => $data['SUBJECT_CODE'],
                'SUBJECT_NAME' => $data['SUBJECT_NAME'],
                'NUM_OF_CREDIT' => $data['NUM_OF_CREDIT'],
                'POINT' => array(
                    $data['POINT_TYPE'] => $data['POINT']
                )
            );
        } else {
            $data_filter[$key]['POINT'][$data['POINT_TYPE']] = $data['POINT'];
        }
    }

    function calculateGPA($data_point)
    {
        $d = 0.0;
        $t = 0.0;
        foreach ($data_point as $data) {
            $point = calculatePoint($data['POINT']);
            $d += $point['D'];
            $t += (float)$point['D'] * (int)$data['NUM_OF_CREDIT'];
        }
        return round($t / (float)$d, 2);
    }

    function calculatePoint($point)
    {
        $sum = 0.0;
        $d = 0.0;
        foreach ($point as $point_type => $p) {
            if ($point_type == 'QT') {
                $sum += $p * 0.3;
            } elseif ($point_type == 'CK') {
                $sum += $p * 0.7;
            }
        }
        
        if ($sum >= 9.5) {
            $char = 'A+';
            $d = 4.0;
        } elseif ($sum >= 8.5) {
            $char = 'A';
            $d = 4.0;
        } elseif ($sum >= 8.0) {
            $char = 'B+';
            $d = 3.5;
        } elseif ($sum >= 7.0) {
            $char = 'B';
            $d = 3.0;
        } elseif ($sum >= 6.5) {
            $char = 'C+';
            $d = 2.5;
        } elseif ($sum >= 5.5) {
            $char = 'C';
            $d = 2.0;
        } elseif ($sum >= 5.0) {
            $char = 'D+';
            $d = 1.5;
        } elseif ($sum >= 4.0) {
            $char = 'D';
            $d = 1.0;
        } else {
            $char = 'F';
        }

        return array(
            'SUM' => round($sum, 1),
            'D' => $d,
            'CHAR' => $char
        );
    }

?>
<h2 class=" mt-2 text-info">Lịch sử quá trình học tập</h2>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 pl-0">
            <p class="mb-1">Viện đào tạo: <b><?= $training_institute['TRAINING_INSTITUTE_NAME']?></b></p>
            <p class="mb-1">Ngành học: <b><i><?= $training_institute['TRAINING_MAJORS_NAME']?></i></b></p>
            <p class="mb-1">Hệ thống đào tạo: <b><?= $training_system['TRAINING_SYSTEM_NAME']?></b></p>
        </div>
        <div class="col-sm-3 pl-0">
            <h5 class="mb-1">CPA: <?= calculateGPA($data_filter)?></h5>
        </div>
    </div>
</div>
<!--<a href="?r=them-moi-nguoi-dung" class="btn btn-success">Thêm mới</a>-->
<!--<a href="" class="btn btn-info">Import</a>-->
<!--<a href="" class="btn btn-secondary">Export</a>-->
<div class="table-responsive mt-2">
    <table class="table table-striped table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center" style="width: 3%; line-height: 350%;" rowspan="2">STT</th>
                <th class="text-center" style="width: 6%; line-height: 350%;" rowspan="2">Mã học phần</th>
                <th class="text-center" style="width: 20%; line-height: 350%;" rowspan="2">Tên học phần</th>
                <th class="text-center" style="width: 3%; line-height: 350%;" rowspan="2">Số TC</th>
                <th class="text-center" style="width: 3%; line-height: 350%;" rowspan="2">Lần học</th>
                <th class="text-center" style="width: 8%;" colspan="5">Điểm quá trình học tập</th>
            </tr>
            <tr>
                <th class="text-center" style="width: 2%;">QT</th>
                <th class="text-center" style="width: 2%;">CK</th>
                <th class="text-center" style="width: 4%;">Tổng điểm</th>
                <th class="text-center" style="width: 5%;">Điểm theo hệ 4</th>
                <th class="text-center" style="width: 6%;">Điểm theo thang chữ</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stt = 1;
        foreach ($data_filter as $data) {
            ?>
            <tr>
                <td class="text-center"><?= $stt?></td>
                <td class="text-center"><?= $data['SUBJECT_CODE']?></td>
                <td class="text-center"><?= $data['SUBJECT_NAME']?></td>
                <td class="text-center"><?= $data['NUM_OF_CREDIT']?></td>
                <td class="text-center">1</td>
                <?php
                foreach ($data['POINT'] as $point_type => $p) {
                ?>
                    <td class="text-center"><?= $p?></td>
                <?php
                }
                $point_cal = calculatePoint($data['POINT']);

                ?>
                <td class="text-center"><?= $point_cal['SUM']?></td>
                <td class="text-center"><?= $point_cal['D']?></td>
                <td class="text-center"><?= $point_cal['CHAR']?></td>
            </tr>
        <?php
        $stt++;
        }
        ?>
        </tbody>
    </table>
</div>
<a href="?r=trang-chu" class="btn btn-secondary">Trở về</a>