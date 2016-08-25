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
            if(!empty($mInputArray['email']) && !empty($mInputArray['password']) )
            {
                #準備存入資料庫之資料

                //目前時間
                $timeNow = date('Y-m-d H:i:s', time());

                // 設置搜尋語法
                $sqlQuery = "SELECT
                            	User_Token.user_token
                            FROM
                            	User ,
                            	User_Token
                            WHERE
                            	User.user_email = '$mInputArray[email]'
                            AND
                            	User.user_password = '$mInputArray[password]'";

                # 下sql 指令
                $sessionToken = $mMysqliClass -> setSearchQuery($sqlQuery)[0]['user_token'];

                if(!empty($sessionToken))
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
