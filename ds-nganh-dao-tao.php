<?php
    $sql = "SELECT * FROM TRAINING_MAJORS AS TM INNER JOIN TRAINING_INSTITUTE AS TI ON TM.TRAINING_INSTITUTE_CODE = TI.TRAINING_INSTITUTE_CODE " .
            "INNER JOIN TRAINING_SYSTEM AS TS ON TM.TRAINING_SYSTEM_CODE = TS.TRAINING_SYSTEM_CODE";
    $training_majors = getAll($connect, $sql);
?>
<h2 class=" mt-2 text-success">Danh sách ngành đào tạo</h2>
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
                        <th class="text-center" style="width: 5%;">Viện đào tạo</th>
                        <th class="text-center" style="width: 5%;">Hệ đào tạo</th>
                        <th class="text-center" style="width: 3%;">Mã ngành đào tạo</th>
                        <th style="width: 5%;">Ngành đào tạo</th>
                        <th class="text-center" style="width: 3%;">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stt = 1;
                    foreach ($training_majors as $item) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $stt?></td>
                            <td class="text-center"><?= $item['training_institute_name']?></td>
                            <td class="text-center"><?= $item['training_system_name']?></td>
                            <td class="text-center"><?= $item['training_majors_code']?></td>
                            <td><?= $item['training_majors_name']?></td>
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