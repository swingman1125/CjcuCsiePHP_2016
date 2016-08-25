<?php
    # incude config data
    include_once '../../inc/config.php';

	# Get input post data
    $mInputPost = $_POST;

    # Get input files data
    $mFiles = (isset($_FILES['picture'])) ? $_FILES['picture'] : null;

    # 設定最後輸出值
    $mOutput = array(
        "code" => 0
    );

    # compare data isset
    if(isset($mInputPost) && !empty($mInputPost) && isset($mFiles) &&  !empty($mFiles))
    {
        # compare api key
        if( $mInputPost['apikey'] === $mApikey)
        {
            # compare sessionToken
            if(!empty($mInputPost['session_token']))
            {
                # 搜尋使用者是否存在
                $sqlQuery = "SELECT
                                User_Token.user_token
                            FROM
                                User_Token
                            WHERE
                                User_Token.user_token = '$mInputPost[session_token]'";

                $sqlResult = $mMysqliClass -> setSearchQuery($sqlQuery);

                # 判別使用者是否存在
                if($sqlResult)
                {
                    #進行上傳
                    if(!empty($mFiles) && $mFiles["error"] == 0)
                    {
                        // 獲取副檔名
                        $ext = substr(strrchr($mFiles['name'], '.'), 1);
                        // 重新命名
                        $fileName = uniqid() . "." . $ext;

                        // 執行上傳動作
                        if(copy( $mFiles['tmp_name'] , $mUploadFolder . $fileName))
                        {
                            $mOutput['code'] = 0;
                            $mOutput['picture_name'] = $fileName;
                        }
                        else
                        {
                            $mOutput['code'] = 7;
                        }
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
