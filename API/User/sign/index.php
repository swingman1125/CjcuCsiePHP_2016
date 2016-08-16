<?php
    // Get Json Post
    $mJsonData = file_get_contents('php://input');

    // Cover Json to array
    $mPostArray = json_decode($mJsonData ,true);

    // database information
    $mDatabaseInfoArray  = array(
        "host"          => "127.0.0.1" ,
        "userName"      => "root",
        "userPassword"  => "root",
        "databaseName"  => "API"
    );


    // 建立連線
    $mConnection = mysqli_connect(
        $mDatabaseInfoArray['host'],
        $mDatabaseInfoArray['userName'],
        $mDatabaseInfoArray['userPassword'],
        $mDatabaseInfoArray['databaseName']
    );


    if (!$mConnection)
    {
        echo "connection false!";
        exit;
    }
    else
    {
        // echo "connection success!";

        $mPostAccount   = $mPostArray['User']['account'];
        $mPostPassword  = $mPostArray['User']['password'];
        $mPostEmail     = $mPostArray['User']['email'];
        $mPostPhone     = $mPostArray['User']['phone'];
        $mPostAddress   = $mPostArray['User']['address'];
        $mPostName      = $mPostArray['User']['name'];

        # 新增的動作
        $mSqlQuery = "INSERT INTO
	                       User
                    (
	                    user_account,
	                    user_password,
	                    user_email,
	                    user_phone,
	                    user_address,
	                    user_name
                    )
                    VALUE
                    (
                        '$mPostAccount',
                        '$mPostPassword',
                        '$mPostEmail',
                        '$mPostPhone',
                        '$mPostAddress',
                        '$mPostName'
                    )";

        echo $mSqlQuery;

        $mConnection->query($mSqlQuery);

        echo ""
    }



    mysqli_close($mConnection);



?>
