<?php
    $sql = "SELECT * FROM SUBJECT AS S INNER JOIN TRAINING_MAJORS AS TM ON S.TRAINING_MAJORS_CODE = TM.TRAINING_MAJORS_CODE INNER JOIN TRAINING_SYSTEM AS TS " .
           "ON TM.TRAINING_SYSTEM_CODE = TS.TRAINING_SYSTEM_CODE";
    $list_subject = getAll($connect, $sql);
?>
<h2 class=" mt-2 text-success">Danh sách học phần</h2>
<hr>
<a href="" class="btn btn-success">Thêm mới</a>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 pl-0">
            <div class="table-responsive mt-2">
                <table class="table table-striped table-sm table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 1%;">#</th>
                        <th class="text-center" style="width: 8%;">Ngành đào tạo</th>
                        <th class="text-center" style="width: 6%;">Hệ đào tạo</th>
                        <th class="text-center" style="width: 3%;">Mã học phần</th>
                        <th style="width: 10%;">Tên học phần</th>
                        <th class="text-center" style="width: 2%;">Số tín chỉ</th>
                        <th class="text-center" style="width: 3%;">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stt = 1;
                    foreach ($list_subject as $item) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $stt?></td>
                            <td class="text-center"><?= $item['training_majors_name']?></td>
                            <td class="text-center"><?= $item['training_system_name']?></td>
                            <td class="text-center"><?= $item['subject_code']?></td>
                            <td><?= $item['subject_name']?></td>
                            <td class="text-center"><?= $item['num_of_credit']?></td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="" class="btn btn-sm btn-danger">Xóa</a>
                            </td>
                        </tr>
                    <?php
                        $stt++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<a href="?r=trang-chu" class="btn btn-secondary">Trở về</a>