<?php
    require_once 'MM_Mysql_Class.php';
    require_once 'MM_Tools_Class.php';

    # apikey
    $mApikey = 'jj9j9c2-FKfjwe=/fewfjweFEJIwmelwf';

    # upload folder
    $mUploadFolder = '../../uploadData/';

    # server path
    $mServerUploadDataPath = "http://" . $_SERVER['HTTP_HOST'] . "/CjcuCsiePHP_2016/apiSample/uploadData/";

    # mysql 連線資訊
    $mMysqlConfig = array(
       "Host"      => "127.0.0.1",
       "Database"  => "ApiSampleDatabase",
       "Port"      => "3306",
       "Username"  => "root",
       "Password"  => "root",
       "Chartset"  => "UTF8",
       "Device"    => "mysql"
    );


    # 呼叫Class
    $mMysqliClass = new MM_Mysql_Class($mMysqlConfig);
    $mToolsClass = new MM_Tools_Class($mMysqlConfig);


?>
