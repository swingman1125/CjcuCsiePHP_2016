<?php
    # incude config data
    include_once '../../inc/config.php';

	# Get input json data
    $mInputJson = file_get_contents('php://input');

    # decode json to  array
    $mInputArray = json_decode($mInputJson ,true);

    # 設定最後輸出值
    $mOutput = array(
        "code" => 0
    );

    # compare data isset
    if(isset($mInputArray) && !empty($mInputArray) )
    {
        # compare api key
        if( $mInputArray['apikey'] === $mApikey)
        {
            # compare params not empty
            if(!empty($mInputArray['email']) && !empty($mInputArray['password']) && !empty($mInputArray['name']) )
            {
                #準備存入資料庫之資料

                //目前時間
                $timeNow = date('Y-m-d H:i:s', time());
                // 生成目前timestamp
                $timestamp = $mToolsClass -> getTimeStamp();
                // 生成sessiontoken
                $sessionToken = $mToolsClass -> makeSessionToken($mInputArray['name'] , $mInputArray['password'] ,$timestamp);

                # 新增一筆會員資料
                $sqlQuery = "INSERT INTO
	                           User
                            (
                            	user_name ,
                                user_password,
                            	user_email,
                            	user_created_time
                            )
                            VALUES
                            (
                            	'$mInputArray[name]',
                            	'$mInputArray[password]',
                            	'$mInputArray[email]',
                                '$timeNow'
                            )";

                # 下新增指令 mysql
                $lastInsertId = $mMysqliClass -> setInsertQuery($sqlQuery);

                # 新增SessionToken
                $sqlQuery = "INSERT INTO
                                    User_Token
                             (
                                 user_token ,
                                 user_id,
                                 user_token_created_time
                             )

                            VALUES
                            (
                                '$sessionToken',
                                '$lastInsertId',
                                '$timeNow'
                            )";

                # 新增userToken
                $mMysqliClass -> setInsertQuery($sqlQuery);

                if($lastInsertId)
                {

                    $mOutput['code'] = 0;
                    $mOutput['session_token'] = $sessionToken;
                }
                else
                {
                    $mOutput['code'] = 4;
                }

            }
            else
            {
                $mOutput['code'] = 6;
            }
        }
        else
        {
            $mOutput['code'] = 3;
        }
    }
    else
    {
        http_response_code(500);
        $mOutput['code'] = 1;
    }

    # 做最後輸出
    echo json_encode($mOutput);

?>
