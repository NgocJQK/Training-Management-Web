<?php
    function getInfoLoginFromSession()
    {
        $key = 'user_login';
        if (isset($_SESSION[$key])) {
            $data = $_SESSION[$key];
            return $data;
        }
        return array();
    }

    function setDataToSession($key, $val)
    {
        try {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }

            $_SESSION[$key] = $val;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    
    function redirect($file = 'index.php')
    {
        header("Location: {$file}");
    }

    function checkUserTypeIsAdmin()
    {
        $info_user = getInfoLoginFromSession();
        
        if (empty($info_user) == false) {
            $user_type = $info_user['user_type'];
            if ($user_type == 'admin') {
                return true;
            }
        }
        return false;
    }

    function checkUserTypeIsStudent()
    {
        $info_user = getInfoLoginFromSession();

        if (empty($info_user) == false) {
            $user_type = $info_user['user_type'];
            if ($user_type == 'student') {
                return true;
            }
        }
        return false;
    }

    function checkUserTypeIsLecturer()
    {
        $info_user = getInfoLoginFromSession();

        if (empty($info_user) == false) {
            $user_type = $info_user['user_type'];
            if ($user_type == 'lecturer') {
                return true;
            }
        }
        return false;
    }

    function getFullnameUserLogin()
    {
        $info_user = getInfoLoginFromSession();
        
        if (empty($info_user) == false) {
            $fullname = $info_user['fullname'];
            return $fullname;
        }
        return '';
    }

    function getUserIdLogin()
    {
        $info_user = getInfoLoginFromSession();

        if (empty($info_user) == false) {
            $fullname = $info_user['id'];
            return $fullname;
        }
        return '';
    }

?>