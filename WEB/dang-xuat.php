<?php
    session_start();
    session_destroy();
    header("Location: dang-nhap.php");
?>