<?php  

	/**
	 * 
	 * @authors Mars (mars@iniu.com.tw)
	 * @date    2014-08-15 16:00:00
	 * @version v1.0
	 *
	 *
	 * 雜項工具

	 		1. 比對 json 格式
	 		2. 比對 APi Key
	 		3. 產生 Session Token
	 		4. 取得 TimeStamp
	 		5. 
	 */



	class MM_Tools_Class 
	{
		
		public function __construct()
		{

		}

		# 比對 Json 是否符合格式
		public function compareJson($_data , $_method)
	    {
	    	$result = "";

	    	switch ($_method) 
	    	{
	    		case 'encode':
	    			json_encode($_data,true);
	    			$result = (json_last_error() == JSON_ERROR_NONE) ? json_encode($_data,true) : false;
	    			break;
	    		
	    		case 'decode':
	    			json_decode($_data,true);
	    			$result = (json_last_error() == JSON_ERROR_NONE) ? json_decode($_data,true) : false;
	    			break;
	    	}

	    	return $result;
	    }

	    # 比對 ApiKey
	    public function compareApiKey($_apiKey , $_compareKey)
	    {
	    	$resultArr = array_keys($_apiKey, $_compareKey);

	    	return (!empty($resultArr)) ? $resultArr[0] : false ;
	    }

	    # 產生 Session Token
	    public function makeSessionToken($_data1, $_data2, $_time)
		{
			$encrypted = base64_encode(sha1($_data1 . $_time, true) . $_time);
			$signature = "";
			if (function_exists('hash_hmac'))
			{
				$signature = base64_encode(hash_hmac("sha1", $encrypted, $_data2, true));
			}
			else
			{
				$blocksize = 250;
				$hashfunc = 'sha1';
				if (strlen($_data2) > $blocksize)
				{
					$_data2 = pack('H*', $hashfunc($_data2));
				}
				$_data2 = str_pad($_data2, $blocksize, chr(0x00));
				$ipad = str_repeat(chr(0x36), $blocksize);
				$opad = str_repeat(chr(0x5c), $blocksize);
				$hmac = pack('H*', $hashfunc(($_data2 ^ $opad) . pack('H*', $hashfunc(($_data2 ^ $ipad) . $_data1))));
				$signature = base64_encode($hmac);
				return $signature;
			}
		
			return $signature;
		}

		# 取得目前 TimeStamp
		public function getTimeStamp()
		{
			// date_default_timezone_set('Asia/Taipie');
			return strtotime(date("YmdHis"));
		}

		# 日期格式轉換 Timestamp -> Y年m月d日 H時i分m秒 x毫秒 , tag 參數範例：Y-m-d H:i:s x
		public function microtime_format($_tag, $_time)
		{
			list($usec, $sec) = explode(".", $_time);
			$date = date($_tag,$usec);
			return str_replace('x', $sec, $date);
		}
		
		# 我忘記功能了
		public function microtime_float()
		{
			list($usec, $sec) = explode(" ", microtime());
			return ((float)$usec + (float)$sec);
		}

		# 產生亂數大寫字串
		public function getRandomString($_length)
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$randomString = '';
    		for ($i = 0; $i < 4; $i++) 
    		{
        		$randomString .= strtoupper( $characters[rand(0, strlen($characters) - 1)] );
    		}
    		return $randomString;
		}

		# Error Code
		public function getErrorCodeArr($_code)
		{
			# Error Code
			$mErrorCode = array(
								
									'0' => 0 , // Success
									'1' => 1 , // Invalid parameters
									'2' => 2 , // Missing required parameters
									'3' => 3 , // Invalid API key
									'4' => 4 , // Internal errors
									'5' => 5 , // Generic error
									'6' => 6 , // Resource not found
									'7' => 7 , // Access denied
									'8' => 8 , // status close
									'1001' => 1001 , // Invalid account or password
									'3001' => 3001 , // invalid SMS token
									'3002' => 3002 , // phone number has been created
									'6001' => 6001   // apply fail
							);

			return json_encode(array( "code" => $mErrorCode[$_code]));
		}


		/* 電話正規表示 */
		public function comparePhone($_number)
		{
			return (preg_match("/09[0-9]{2}[0-9]{6}/", $_number)) ? true : false;
		}
		/* email正規表示 */
		public function compareEmail($_Email)
		{
			return (preg_match("/^([a-z0-9_]|\-|\.)+@(([a-z0-9_]|\-)+\.){1,2}[a-z]{2,4}$/i",$_Email)) ? true : false;
		}
		public function jump($url)
		{
			$Grammar = '';

			$Grammar .= "<script type='text/javascript'>";
			$Grammar .= "window.location.href='$url'";
		    $Grammar .= "</script>"; 

		    return $Grammar ;
		}
		/* 推播服務 Android
			參數設定 : API_key   : service api key.
                      APP_id    : service app user_id.
                      message   : will send information.
		*/
		public function GCM($API_key,$APP_id,$message)
		{
			$url = 'https://android.googleapis.com/gcm/send';	
		
			$json = array(
		            'registration_ids' => $APP_id,
		            'data' => $message
		        );

			$json = json_encode($json);

			$headers = array(
		            'Authorization: key=' . $API_key,
		            'Content-Type: application/json'
		        );
				
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	//忽略SSL驗證
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
			$result = curl_exec($curl);
			curl_close($curl);
		   
		   $string = array(
		   					'message' => $message,
		   					'json' => $json,
		   					'header' => $headers,
		   					'result' => $result
						   	);
		   $string = json_encode($string);
		   return $result;
			
		}
		/* 推播服務  IOS
			參數設定 :  API_token    : service api key.
					   API_Passwd  : service api passwd.
                       APP_id      : service app user_id.
                      _message     : will send information.
		*/
		public function APNS($API_token,$API_Passwd,$APP_id,$_message)
		{
			$callback = array();

			// Passphrase for the private key (ck.pem file)

			// Get the parameters from HTTP get or from command line

			$message = $_message or $message = $argv[1] or $message = '捍衛台灣，退回服貿';

			// icon 旁未讀訊息設定
			$badge = 0;

			// 推播時音效設定
			$sound='default';

			// Construct the notification payload

			$body = array();

			// 判斷回答狀態
			switch ($message['method']) 
			{
				case 'question_bestanswer':
					
					// push notification 
					$body['aps'] = array('alert' => "您的回答被選為了最佳解，快去看看！");

					break;

				case 'question_bestanswer_follow':
					
					// push notification 
					$body['aps'] = array('alert' => "您追蹤的問題出現了最佳解，快去看看！");

					break;

				case 'question_answer':
					
					// push notification 
					$body['aps'] = array('alert' => "您的問題有新的回答，快去看看！");

					break;

				case 'question_follow':
					
					// push notification 
					$body['aps'] = array('alert' => "您追蹤的問題有新的回答，快去看看！");

					break;

				default:
					# code...
					break;
			}

		
			// push content
			$body['aps']['data'] = $message['data'];

			if ($badge) {

				$body['aps']['badge'] = $badge;
			}

			$body['aps']['sound'] = $sound;

			/* End of Configurable Items */

			$ctx = stream_coNtext_create();

			stream_coNtext_set_option($ctx, 'ssl', 'local_cert', $API_token);

			// assume the private key passphase was removed.

			stream_coNtext_set_option($ctx, 'ssl', 'passphrase', $API_Passwd);

			// connect to apns

			$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

			if (!$fp) 
			{

				$callback['callback'] =  "Failed to connect $err $errstrn";

			}

			else {

				$callback['callback'] =  "Connection OKn<br/>";

			}

			// send message

			$payload = json_encode($body);

			foreach ($APP_id as $key => $value) 
			{
				$msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $value)) . pack("n",strlen($payload)) . $payload;

			}

			$callback['message'] =  "Sending message :" . $payload . "n";

			fwrite($fp, $msg);

			fclose($fp);

			// its array
			return $callback;
		}
		
	}

?>