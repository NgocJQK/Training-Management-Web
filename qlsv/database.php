<?php
    $host = 'localhost';
    $username_database = 'root';
    $password_database = '';
    $db_name = 'qldt';
    function connectDatabase($host, $username, $password, $db_name)
    {
        $connect = null;
        try {
            $connect = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connect->exec("set names utf8");
        } catch (Exception $e) {
            echo "Connect db failed: " . $e->getMessage();
            die();
        }

        return $connect;
    }

    function getOne($instance_db, $sql)
    {
        $stmt = $instance_db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getAll($instance_db, $sql)
    {
        $stmt = $instance_db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    function getInfoLogin($instance_db, $username, $password)
    {
        if ($username === '' || $password === '') {
            return array();
        }
        $sql = "SELECT * FROM USER WHERE USERNAME = '{$username}' AND PASSWORD = '{$password}'";
        return getOne($instance_db, $sql);
    }

    function insert($instance_db, $sql, $data)
    {
        $stmt = $instance_db->prepare($sql);
        return $stmt->execute($data);
    }

    function update($instance_db, $sql, $data)
    {
        $stmt = $instance_db->prepare($sql);
        return $stmt->execute($data);
    }

    function delete($instance_db, $sql, $data)
    {
        $stmt = $instance_db->prepare($sql);
        return $stmt->execute($data);
    }
?>