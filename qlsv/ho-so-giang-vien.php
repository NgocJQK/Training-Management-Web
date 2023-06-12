<?php
    $sql = "SELECT * FROM USER WHERE USER_TYPE = 'lecturer'";
    $list_user_lecturer = getAll($connect, $sql);
?>
<h2 class=" mt-2 text-success">Hồ sơ giảng viên</h2>
<hr>
<?php
    if ($check_is_student != true) {
        echo '<a href="?r=them-moi-nguoi-dung" class="btn btn-success">Thêm mới</a>';
    }
?>
<div class="table-responsive mt-2">
    <table class="table table-striped table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center" style="width: 3%;">#</th>
                <th style="width: 20%;">Họ và tên</th>
                <th class="text-center" style="width: 7%;">Ngày sinh</th>
                <th class="text-center" style="width: 8%;">SĐT</th>
                <th class="text-center" style="width: 8%;">Email</th>
                <?php
                    if ($check_is_student != true) {
                        echo '<th class="text-center" style="width: 8%;">Tên tài khoản</th>';
                    }
                ?>
                <th class="text-center" style="width: 8%;">Mã giảng viên</th>
                <th class="text-center">Địa chỉ</th>
                <?php
                    if ($check_is_student != true) {
                        echo '<th class="text-center" style="width: 6%;">Trạng thái</th>';
                        echo '<th class="text-center" style="width: 8%;">Hành động</th>';
                    }
                ?>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($list_user_lecturer as $lecturer) {
        ?>
            <tr>
                <td class="text-center"><?= $lecturer['id']?></td>
                <td><?= $lecturer['fullname']?></td>
                <td class="text-center"><?= $lecturer['dob']?></td>
                <td class="text-center"><?= $lecturer['phone_number']?></td>
                <td class="text-center"><?= $lecturer['email']?></td>
                <?php
                    if ($check_is_student != true) {
                        echo '<td class="text-center">' . $lecturer['username'] . '</td>';
                    }
                ?>
                <td class="text-center"><?= $lecturer['user_code']?></td>
                <td class="text-center"><?= $lecturer['address']?></td>
                <?php
                    if ($check_is_student != true) {
                        echo '<td class="text-center">' . $lecturer['status'] . '</td>';
                        echo '<td class="text-center">';
                        echo '<a href="?r=cap-nhat-nguoi-dung&user_id=' . $lecturer['id'] .'" class="btn btn-sm btn-warning mr-1">Sửa</a>' ;
                        echo '<a href="?r=xoa-nguoi-dung&user_id=' . $lecturer['id'] .'" class="btn btn-sm btn-danger">Xóa</a>' ;
                        echo '</td>';
                    }
                ?>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<a href="?r=trang-chu" class="btn btn-secondary">Trở về</a>