<?php
    # mysql 連線資訊
    $mMysqlConfig = array(
        "Host"      => "127.0.0.1",
        "Database"  => "myBandown",
        "Port"      => "3306",
        "Username"  => "root",
        "Password"  => "root",
        "Chartset"  => "UTF8",
        "Device"    => "mysql"
    );

    // echo "<pre>" . print_r($mMysqlConfig , true) . "<pre>";

    # 引入 mysqlClass
    include_once './MM_Mysql_Class.php';

    // 呼叫Class
    $mMysql = new MM_Mysql_Class($mMysqlConfig);

    // sql 語法
    $mSql = "SELECT * FROM User";

    // 呼叫 function
    $mResult = $mMysql -> setQuery($mSql);

    echo "<pre>" . print_r($mResult , true) . "<pre>";



?>
