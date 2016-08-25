<?php
    /*
        功能 :
            接收上傳之檔案頁面

        上傳限制 :
            1. 支援多檔上傳
            2. 上傳之檔案小於 8 MB
            3. 只能上傳 png , jpg
            3. 檔案重新用 unqid 命名
        思考邏輯 :

            1. 判別檔案是否接收
            2. 判別檔案格式
            3. 判別檔案大小
            4. 判別上傳是否成功
    */

    # 基本規則設定

    // 限制的大小
    $fileSizeLimitNum = 1024 * 1024 * 8;
    // 限制的附檔名類別
    $fileTypeArray = array(
        "png" ,
        "jpg"
    );
    // 上傳位置
    $uploadFolder = "./files/";

    # 判斷是否有檔案上傳
    if( isset($_FILES) && !empty($_FILES))
    {
        /*
            因為多檔上傳的格式不利於跑foreach迴圈，
            於是轉寫了一支 function reArrayFiles()
            來將FILES的陣列重組，方便之後的程序。

            ex : 不懂的話可以直接將 $_FILES and $uploadArray print_r 就知道了。
        */
        $uploadArray = reArrayFiles($_FILES['filesList']);

        # 執行上傳動做
        foreach ($uploadArray as $key => $value)
        {
            echo "<pre>" . print_r($value , true) . "</pre>";
            // 取得附檔名
            $extension = pathinfo($value['name'], PATHINFO_EXTENSION);

            // 判別檔案格式及大小
            if(in_array($extension,$fileTypeArray) && $value['size'] < $fileSizeLimitNum)
            {
                // 重新命名
                $rename = uniqid() . "." . $extension;

                // 執行上傳動作
                if(copy( $value['tmp_name'] , $uploadFolder .  $rename)){
                    echo $value['name'] . "上傳成功。" . "<br>";
                }
                else
                {
                    echo $value['name'] . "上傳失敗。" . "<br>";
                }

            }
            else
            {
                echo $value['name'] . "上傳失敗";
            }
        }
    }
    else
    {
        echo "無檔案上傳";
        exit;
    }


    // 重新組合上傳陣列方便之後的程序運行
    function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++)
        {
            foreach ($file_keys as $key)
            {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }




?>
