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
                                User_Token.user_id,
                                User.user_name,
                                User.user_email,
                                User.user_photo
                            FROM
                                User_Token,
                                User
                            WHERE
                                User_Token.user_token = '$mInputArray[session_token]'";

                $sqlResult = $mMysqliClass -> setSearchQuery($sqlQuery);

                # 判別使用者是否存在
                if($sqlResult)
                {
                    $mOutput['name']  = $sqlResult[0]['user_name'];
                    $mOutput['email'] = $sqlResult[0]['user_email'];
                    $mOutput['photo'] = (!empty($sqlResult[0]['user_photo'])) ? $mServerUploadDataPath . $sqlResult[0]['user_photo'] : "";
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
