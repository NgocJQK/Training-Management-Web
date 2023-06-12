<?php
    $classroom_id = isset($_GET['classroom_id']) == true ? $_GET['classroom_id'] : '';
    $student_id = isset($_GET['student_id']) == true ? $_GET['student_id'] : '';
    $subject_code = isset($_GET['subject_code']) == true ? $_GET['subject_code'] : '';
    $study_id = isset($_GET['study_id']) == true ? $_GET['study_id'] : '';

    $sql1 = "SELECT FULLNAME, USER_CODE FROM USER WHERE ID = '{$student_id}'";
    $fullname = getOne($connect, $sql1);

    $sql2 = "SELECT * FROM SUBJECT WHERE SUBJECT_CODE = '{$subject_code}'";
    $subject_info = getOne($connect, $sql2);

    $sql1 = "SELECT * FROM STUDYING AS S INNER JOIN USER AS U ON S.STUDENT_ID = U.ID WHERE S.CLASSROOM_ID = '{$classroom_id}'";
    $list_student = getAll($connect, $sql1);

    $sql2 = "SELECT CLASSROOM_NAME FROM CLASSROOM WHERE ID = {$classroom_id}";
    $classroom_name = getOne($connect, $sql2);

    if (isset($_POST['save']) == true) {
        $sql = "INSERT INTO POINT (STUDY_ID, POINT_TYPE, POINT) VALUES(?, ?, ?)";
        $point_qt = isset($_POST['qt']) == true ? $_POST['qt'] : '';
        $point_ck = isset($_POST['ck']) == true ? $_POST['ck'] : '';
        $study_id = isset($_POST['study_id']) == true ? $_POST['study_id'] : '';

        $data1 = array(
            $study_id,
            'QT',
            $point_qt
        );
        $data2 = array(
            $study_id,
            'CK',
            $point_ck
        );
        $result1 = insert($connect, $sql, $data1);
        $result2 = insert($connect, $sql, $data2);
        if ($result1 == true && $result2 == true) {
            header("Location: ?r=danh-sach-sinh-vien-thuoc-lop&classroom_id={$classroom_id}&subject_code={$subject_code}");
        }
    }

?>
<h2 class="mt-2 text-success">Nhập điểm sinh viên <i>"<?= $fullname['FULLNAME']?>"</i></h2>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 pl-0">
            <p class="mb-1">Mã sinh viên: <b><?= $fullname['USER_CODE']?></b></p>
        </div>
    </div>
</div>
<div class="table-responsive mt-2">
    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center" style="width: 6%; line-height: 350%;" rowspan="2">Mã học phần</th>
                <th class="text-center" style="width: 10%; line-height: 350%;" rowspan="2">Tên học phần</th>
                <th class="text-center" style="width: 3%; line-height: 350%;" rowspan="2">Số TC</th>
                <th class="text-center" style="width: 3%; line-height: 350%;" rowspan="2">Lần học</th>
                <th class="text-center" style="width: 8%;" colspan="2">Điểm quá trình học tập</th>
                <th class="text-center" style="width: 3%; line-height: 350%;" rowspan="2">Hành động</th>
            </tr>
            <tr>
                <th class="text-center" style="width: 2%;">QT</th>
                <th class="text-center" style="width: 2%;">CK</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><?= $subject_info['subject_code']?></td>
                <td class="text-center"><?= $subject_info['subject_name']?></td>
                <td class="text-center"><?= $subject_info['num_of_credit']?></td>
                <td class="text-center">1</td>
                <form action="#" method="POST">
                    <td class="text-center">
                        <input type="text" class="form-control" name="qt" required>
                    </td>
                    <td class="text-center">
                        <input type="text" class="form-control" name="ck" required>
                        <input type="hidden" value="<?= $study_id?>" name="study_id">
                    </td>
                    <td class="pt-2 text-center">
                        <button type="submit" name="save" class="btn btn-sm btn-primary">Lưu điểm</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
<a href="?r=danh-sach-sinh-vien-thuoc-lop&classroom_id=<?= $classroom_id?>&subject_code=<?= $subject_code?>" class="btn btn-secondary">Trở về</a>