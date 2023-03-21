<?php
    $sql1 = "SELECT * FROM TRAINING_INSTITUTE";
    $training_institute = getAll($connect, $sql1);

    $sql2 = "SELECT * FROM TRAINING_MAJORS";
    $training_majors = getAll($connect, $sql2);

    $sql3 = "SELECT * FROM TRAINING_SYSTEM";
    $training_system = getAll($connect, $sql3);

    $err_msg = '';
    $check = true;

    if (isset($_POST['save']) == true) {
        $sql_insert1 = "INSERT INTO USER(USERNAME, PASSWORD, USER_TYPE, USER_CODE, FULLNAME, DOB, PHONE_NUMBER, EMAIL, ADDRESS) VALUES" .
            "(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql_insert2 = "INSERT INTO PROFILE(USER_ID, TRAINING_INSTITUTE_CODE, TRAINING_MAJORS_CODE, TRAINING_SYSTEM_CODE) VALUES" .
            "(?, ?, ?, ?)";

        $username = isset($_POST['username']) == true ? $_POST['username'] : '';
        $password = isset($_POST['password']) == true ? $_POST['password'] : '';
        $user_type = isset($_POST['user_type']) == true ? $_POST['user_type'] : '';
        $user_code = isset($_POST['user_code']) == true ? $_POST['user_code'] : '';
        $fullname = isset($_POST['fullname']) == true ? $_POST['fullname'] : '';
        $dob = isset($_POST['dob']) == true ? $_POST['dob'] : '';
        $phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : '';
        $email = isset($_POST['email']) == true ? $_POST['email'] : '';
        $address = isset($_POST['address']) == true ? $_POST['address'] : '';

        $training_institute_code = isset($_POST['training_institute']) == true ? $_POST['training_institute'] : '';
        $training_majors_code = isset($_POST['training_majors']) == true ? $_POST['training_majors'] : '';
        $training_system_code = isset($_POST['training_system']) == true ? $_POST['training_system'] : '';

        if ($user_type == 'student') {
            if ($training_majors_code == '') {
                $err_msg = 'Ngành đào tạo là 1 mục bắt buộc !';
                $check = false;
            } elseif ($training_system_code == '') {
                $err_msg = 'Hệ đào tạo là 1 mục bắt buộc !';
                $check = false;
            }
        }

        $data1 = array(
            $username,
            $password,
            $user_type,
            $user_code,
            $fullname,
            $dob,
            $phone_number,
            $email,
            $address
        );

        if ($check == true) {
            $result1 = insert($connect, $sql_insert1, $data1);
            $result2 = false;
            if ($user_type == 'student') {
                $user_id_insert = '';
                if ($result1 == true) {
                    $sql_select_user_id = "SELECT ID FROM USER ORDER BY ID DESC LIMIT 1";
                    $info_user_id = getOne($connect, $sql_select_user_id);
                    $user_id_insert = $info_user_id['ID'];
                }

                $data2 = array(
                    $user_id_insert,
                    $training_institute_code,
                    $training_majors_code,
                    $training_system_code
                );
                $result2 = insert($connect, $sql_insert2, $data2);
            }
            
            if ($result1 == true && $result2 == true && $user_type == 'student') {
                header("Location: ?r=ho-so-sinh-vien");
            } elseif ($result1 == true && $user_type == 'lecturer') {
                header("Location: ?r=ho-so-giang-vien");
            }
        }
    }
?>
<h2 class="mt-2 text-success">Thêm mới người dùng</h2>
<div class="container-fluid p-0">
    <form action="#" method="POST">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" name="fullname" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Ngày sinh</label>
                    <input type="date" class="form-control" name="dob" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">SĐT</label>
                    <input type="text" class="form-control" name="phone_number" required>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <textarea name="address" rows="4" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" required>
                    <label for="">Password</label>
                    <input type="text" class="form-control" name="password" value="123456" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Mã SV, Giảng viên</label>
                    <input type="text" class="form-control" name="user_code" required>
                    <label for="">Loại User</label>
                    <select name="user_type" class="form-control" required>
                        <option value="">-- Chọn --</option>
                        <option value="student">Sinh viên</option>
                        <option value="lecturer">Giảng viên</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Viện đào tạo</label>
                    <select name="training_institute" class="form-control" required>
                        <option value="">-- Chọn --</option>
                        <?php
                            foreach ($training_institute as $item) {
                        ?>
                            <option value="<?= $item['training_institute_code']?>"><?= $item['training_institute_name']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Ngành đào tạo</label>
                    <select name="training_majors" class="form-control" >
                        <option value="">-- Chọn --</option>
                        <?php
                            foreach ($training_majors as $item) {
                        ?>
                            <option value="<?= $item['training_majors_code']?>"><?= $item['training_majors_name']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="">Hệ đào tạo</label>
                    <select name="training_system" class="form-control">
                        <option value="">-- Chọn --</option>
                        <?php
                            foreach ($training_system as $item) {
                        ?>
                            <option value="<?= $item['training_system_code']?>"><?= $item['training_system_name']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p class="text-danger"><?= $err_msg?></p>   
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary" name="save">Lưu</button>
                <a href="?r=trang-chu" class="btn btn-secondary">Trở về</a>
            </div>
        </div>
    </form>
</div>