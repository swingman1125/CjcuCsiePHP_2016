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
    if(isset($mInputArray) && !empty($mInputArray))
    {
        # compare api key
        if( $mInputArray['apikey'] === $mApikey)
        {
            # compare sessionToken
            if(!empty($mInputArray['session_token']))
            {
                # 搜尋使用者是否存在
                $sqlQuery = "SELECT
                                User_Token.user_token,
                                User_Token.user_id
                            FROM
                                User_Token
                            WHERE
                                User_Token.user_token = '$mInputArray[session_token]'";

                $sqlResult = $mMysqliClass -> setSearchQuery($sqlQuery);
                $userId = $sqlResult[0]['user_id'];

                # 判別使用者是否存在
                if($sqlResult)
                {
                    //目前時間
                    $timeNow = date('Y-m-d H:i:s', time());
                    # 更新資料
                    $sqlQuery = "UPDATE
                                    User
                                SET
                                    User.user_photo = '$mInputArray[photo]' ,
                                    User.user_updated_time = '$timeNow'
                                WHERE
                                    User.user_id = '$userId'";

                    if($mMysqliClass -> setUpdateQuery($sqlQuery))
                    {
                        $mOutput['code'] = 0;
                    }
                    else
                    {
                        $mOutput['code'] = 7;
                    }
                }
                else
                {
                    $mOutput['code'] = 7;
                }

            }
            else
            {
                $mOutput['code'] = 7;
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
