<?php
    ob_start();
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Hệ thống quản lý đào tạo</title>
    <?php
    require "layouts/link.php";
    ?>
</head>

<body>
    <?php
        require "database.php";
        require "function.php";
        // Kết nối database
        $connect = connectDatabase($host, $username_database, $password_database, $db_name);

        // Kiểm tra xem user có đang đăng nhập không ? Nếu đăng nhập thì cho sử dụng hệ thống, chưa đăng nhập thì chuyển sang trang đăng nhập
        $info_user = getInfoLoginFromSession();
        if (empty($info_user) === true) {
            redirect("dang-nhap.php");
        }
        $username_login = $info_user['username'];
        $password_login = $info_user['password'];
        $info_user_new = getInfoLogin($connect, $username_login, $password_login);
        
        if (empty($info_user_new) == true) {
            redirect("dang-nhap.php");
        }
    ?>
    <?php
    require "layouts/topbar.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php
            require "layouts/sidebar.php";
            ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                    // Get user id đang login
                    $user_id = getUserIdLogin();

                    // Đường dẫn gốc của website
                    $baseUrl = 'localhost/qldt';

                    // Kiểm tra xem user đang đăng nhập có phải là admin không
                    $check_is_admin = checkUserTypeIsAdmin();

                    // Kiểm tra xem user đang đăng nhập có phải là student không
                    $check_is_student = checkUserTypeIsStudent();

                    // Kiểm tra xem user đang đăng nhập có phải là lecturer không
                    $check_is_lecturer = checkUserTypeIsLecturer();


                    // Áp dụng GET method để xử lý điều hướng đến các page cho phù hợp
                    $r = isset($_GET['r']) == true ? $_GET['r'] : '';
                    if ($r == '') {
                        $r = 'trang-chu';
                    }
                    switch($r) {
                        case 'trang-chu':
                            require "trang-chu.php";
                            break;
                        case 'ho-so-ca-nhan':
                            require "ho-so-ca-nhan.php";
                            break;
                        case 'ho-so-sinh-vien':
                            if ($check_is_admin == true || $check_is_student == true) {
                                require "ho-so-sinh-vien.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;
                        case 'ho-so-giang-vien':
                            if ($check_is_admin == true || $check_is_student == true) {
                                require "ho-so-giang-vien.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;
                        case 'them-moi-nguoi-dung':
                            // Chỉ có user admin mới được xem mục này
                            // Nếu $check_is_admin == true => là admin, ngược lại thì không phải
                            if ($check_is_admin == true) {
                                require "them-moi-nguoi-dung.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;

                        case 'cap-nhat-nguoi-dung':
                            // Chỉ có user admin mới được xem mục này
                            // Nếu $check_is_admin == true => là admin, ngược lại thì không phải
                            if ($check_is_admin == true) {
                                require "cap-nhat-nguoi-dung.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;
                        case 'xoa-nguoi-dung':
                            // Chỉ có user admin mới được xem mục này
                            // Nếu $check_is_admin == true => là admin, ngược lại thì không phải
                            if ($check_is_admin == true) {
                                require "xoa-nguoi-dung.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;
                        case 'ds-vien-dao-tao':
                            // Chỉ có user admin mới được xem mục này
                            // Nếu $check_is_admin == true => là admin, ngược lại thì không phải
                            if ($check_is_admin == true) {
                                require "ds-vien-dao-tao.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;
                        case 'ds-nganh-dao-tao':
                            // Chỉ có user admin mới được xem mục này
                            // Nếu $check_is_admin == true => là admin, ngược lại thì không phải
                            if ($check_is_admin == true) {
                                require "ds-nganh-dao-tao.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;
                        case 'ds-hoc-phan':
                            // Chỉ có user admin mới được xem mục này
                            // Nếu $check_is_admin == true => là admin, ngược lại thì không phải
                            if ($check_is_admin == true) {
                                require "ds-hoc-phan.php";
                            } else {
                                require "khong-duoc-truy-cap.php";
                            }
                            break;
                        case 'lich-su-qua-trinh-hoc-tap':
                            // Chỉ có student mới xem được lịch sử quá trình học tập của họ
                            // Nếu $check_is_student == true => là student, ngược lại thì không phải
                            if ($check_is_student == true) {
                                require "lich-su-qua-trinh-hoc-tap.php";
                            } else {
                                require "page-not-found.php";
                            }
                            break;
                        case 'danh-sach-hoc-phan':
                            // Chỉ có student mới xem được danh sách các học phần
                            // Nếu $check_is_student == true => là student, ngược lại thì không phải
                            if ($check_is_student == true) {
                                require "danh-sach-hoc-phan.php";
                            } else {
                                require "page-not-found.php";
                            }
                            break;
                        case 'dang-ky-hoc-phan':
                            // Chỉ có student mới sử dụng được chức năng đăng ký học phần
                            // Nếu $check_is_student == true => là student, ngược lại thì không phải
                            if ($check_is_student == true) {
                                require "dang-ky-hoc-phan.php";
                            } else {
                                require "page-not-found.php";
                            }
                            break;
                        case 'hoc-phan-da-dang-ky':
                            // Chỉ có student mới xem được lịch sử quá trình học tập của họ
                            // Nếu $check_is_student == true => là student, ngược lại thì không phải
                            if ($check_is_student == true) {
                                require "danh-sach-hoc-phan-da-dang-ky.php";
                            } else {
                                require "page-not-found.php";
                            }
                            break;
                        case 'hoc-phan-chi-dinh-giang-day':
                            // Chỉ có lecturer mới xem được các học phần mà họ được chỉ định giảng dạy
                            // Nếu $check_is_lecturer == true => là lecturer, ngược lại thì không phải
                            if ($check_is_lecturer == true) {
                                require "danh-sach-hoc-phan-duoc-chi-dinh-giang-day.php";
                            } else {
                                require "page-not-found.php";
                            }
                            break;
                        case 'danh-sach-sinh-vien-thuoc-lop':
                            // Chỉ có lecturer mới xem được các học phần mà họ được chỉ định giảng dạy
                            // Nếu $check_is_lecturer == true => là lecturer, ngược lại thì không phải
                            if ($check_is_lecturer == true) {
                                require "danh-sach-sinh-vien-thuoc-lop.php";
                            } else {
                                require "page-not-found.php";
                            }
                            break;
                        case 'nhap-diem':
                            // Chỉ có lecturer mới xem được các học phần mà họ được chỉ định giảng dạy
                            // Nếu $check_is_lecturer == true => là lecturer, ngược lại thì không phải
                            if ($check_is_lecturer == true) {
                                require "nhap-diem.php";
                            } else {
                                require "page-not-found.php";
                            }
                            break;
                        default:
                            require "page-not-found.php";
                            break;    
                    }
                ?>
            </main>
        </div>
    </div>
    <?php
        // Ngắt kết nối database
        $connect = null;
    ?>
</body>
</html>