<?php
    /*
        This is a mysql class for query
     */

    class MM_Mysql_Class
    {
        # class 物件設定
        protected $mDbHost 		= '';
		protected $mDbDatabase 	= '';
		protected $mDbUserName 	= '';
		protected $mDbPassWord 	= '';
		protected $mDbPort 		= '';
		protected $mDbDevice 	= '';
		protected $mDbCharset 	= '';
        protected $mConnection  = '';

        # 建構子
        public function __construct($_config = array())
        {
            $this -> config($_config);
            $this -> connect();
        }
        # 連線設置
        private function config($_config = array())
        {
            $this -> mDbHost 	 = $_config['Host'];
            $this -> mDbDatabase = $_config['Database'];
            $this -> mDbUserName = $_config['Username'];
            $this -> mDbPassWord = $_config['Password'];
            $this -> mDbPort 	 = $_config['Port'];
            $this -> mDbDevice 	 = $_config['Device'];
            $this -> mDbCharset  = $_config['Chartset'];
        }
        # 連線
        private function connect()
        {
            $this -> mConnection = mysqli_connect(
                $this -> mDbHost  ,
                $this -> mDbUserName,
                $this -> mDbPassWord,
                $this -> mDbDatabase
            );
            if (!$this -> mConnection)
            {
                // echo "Error: Unable to connect to MySQL." . PHP_EOL;
                // echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                // echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
            else
            {
                // echo '資料庫已連線' . "<br>";
            }
        }

        # 下搜尋基本指令
        public function setSearchQuery($_sql)
        {
            $_result = $this -> mConnection -> query($_sql);

            $output = array();

            while($row = $_result->fetch_assoc())
            {
                array_push($output , $row);
            }
            return (!empty($output)) ? $output : false;
        }

        # 下 新增 指令
        public function setInsertQuery($_sql)
        {
            if($this -> mConnection -> query($_sql))
            {
                // 如果指令下成功就回傳新增的id
                return $this -> mConnection ->insert_id;
            }
            else
            {
                // 沒有就回false
                return false;
            }

        }

        # 下 新增 指令
        public function setUpdateQuery($_sql)
        {
            if($this -> mConnection -> query($_sql))
            {
                // 如果指令下成功就回傳新增的id
                return true;
            }
            else
            {
                // 沒有就回false
                return false;
            }

        }


        # 解構子
        public function __destruct()
        {
            mysqli_close($this -> mConnection);
            // echo "資料庫已中斷連線" . "<br>";
        }
    }
?>
