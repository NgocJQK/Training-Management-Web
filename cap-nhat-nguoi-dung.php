<?php
    // Lấy ra user_id trên URL được gửi từ trang hố sơ sinh viên, giảng viên
    $user_id = isset($_GET['user_id']) == true ? $_GET['user_id'] : '';
    $user_info = array();
    if ($user_id != '') {
        $sql_select = "SELECT * FROM USER WHERE ID = {$user_id}";
        $user_info = getOne($connect, $sql_select);
    }
    if (empty($user_info) == true) {
        header("Location: ?r=page-not-found");
    }
    if (isset($_POST['save']) == true) {
        $sql = "UPDATE USER SET USERNAME = ?, PASSWORD = ?, USER_TYPE = ?, USER_CODE = ?, FULLNAME = ?, DOB = ?, PHONE_NUMBER = ?, EMAIL = ?, ADDRESS = ? " .
            "WHERE ID = ?";
        $username = isset($_POST['username']) == true ? $_POST['username'] : '';
        $password = isset($_POST['password']) == true ? $_POST['password'] : '';
        $user_type = isset($_POST['user_type']) == true ? $_POST['user_type'] : '';
        $user_code = isset($_POST['user_code']) == true ? $_POST['user_code'] : '';
        $fullname = isset($_POST['fullname']) == true ? $_POST['fullname'] : '';
        $dob = isset($_POST['dob']) == true ? $_POST['dob'] : '';
        $phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : '';
        $email = isset($_POST['email']) == true ? $_POST['email'] : '';
        $address = isset($_POST['address']) == true ? $_POST['address'] : '';
        $data = array(
            $username,
            $password,
            $user_type,
            $user_code,
            $fullname,
            $dob,
            $phone_number,
            $email,
            $address,
            $user_id
        );
        $result = update($connect, $sql, $data);
        if ($result == true  && $user_type == 'student') {
            header("Location: ?r=ho-so-sinh-vien");
        } elseif ($result == true  && $user_type == 'lecturer') {
            header("Location: ?r=ho-so-giang-vien");
        }
    }
?>
<h2 class="mt-2 text-warning">Cập nhật thông tin người dùng</h2>
<div class="container-fluid p-0">
    <form action="#" method="POST">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" name="fullname" value="<?= $user_info['fullname']?>" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Ngày sinh</label>
                    <input type="date" class="form-control" name="dob" value="<?= $user_info['dob']?>" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">SĐT</label>
                    <input type="text" class="form-control" name="phone_number" value="<?= $user_info['phone_number']?>" required>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" value="<?= $user_info['email']?>" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <textarea name="address" rows="4" class="form-control"><?= $user_info['address']?></textarea>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $user_info['username']?>" required>
                    <label for="">Password</label>
                    <input type="text" class="form-control" name="password" value="<?= $user_info['password']?>" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Mã SV, Giảng viên</label>
                    <input type="text" class="form-control" name="user_code" value="<?= $user_info['user_code']?>" required>
                    <label for="">Loại User</label>
                    <select name="user_type" class="form-control" required>
                        <option value="">-- Chọn --</option>
                        <option value="student">Sinh viên</option>
                        <option value="lecturer">Giảng viên</option>
                        <option value="<?= $user_info['user_type']?>" selected><?= $user_info['user_type'] == 'student' ? 'Sinh viên' : 'Giảng viên'?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary" name="save">Lưu thay đổi</button>
                <a href="?r=trang-chu" class="btn btn-secondary">Trở về</a>
            </div>
        </div>
    </form>
</div>