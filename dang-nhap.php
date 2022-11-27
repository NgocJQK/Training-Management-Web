<?php
    ob_clean();
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
    <title>Đăng nhập</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="image/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="image/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="image/favicon-16x16.png" sizes="16x16" type="image/png">
    <!-- <link rel="manifest" href="json/manifest.json"> -->
    <link rel="mask-icon" href="image/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="image/favicon.ico">
    <meta name="msapplication-config" content="image/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <?php
        require "database.php";
        require "function.php";
        // Kết nối database
        $connect = connectDatabase($host, $username_database, $password_database, $db_name);
        $error_msg = '';

        // Kiểm tra xem nếu người dùng bấm vào nút đăng nhập thì sẽ đi thực hiện đăng nhập
        if (isset($_POST['is_login']) == true) {
            // Lấy ra thông tin tài khoản + mật khẩu được gửi lên server để kiểm tra đăng nhập
            $username_login = isset($_POST['username']) == true ? $_POST['username'] : '';
            $password_login = isset($_POST['password']) == true ? $_POST['password'] : '';

            $info_user = getInfoLogin($connect, $username_login, $password_login);
            if (empty($info_user) === true) {
                $error_msg = 'Thông tin tài khoản hoặc mật khẩu không chính xác';
            } else {
                $result = setDataToSession('user_login', $info_user);
                if ($result == true) {
                    redirect("index.php");
                }
            }
        }       
    ?>
    <form class="form-signin" method="POST" action="#">
        <img class="mb-4" src="image/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Vui lòng đăng nhập</h1>
        <label for="inputEmail" class="sr-only">Tài khoản</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Tài khoản" required autofocus name="username">
        <label for="inputPassword" class="sr-only">Mật khẩu</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required name="password">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Nhớ tôi
            </label>
        </div>
        <p class="text-danger"><?= $error_msg?></p>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="is_login">Đăng nhập</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
    <?php
        // Ngắt kết nối database
        $connect = null;
    ?>
</body>
</html>