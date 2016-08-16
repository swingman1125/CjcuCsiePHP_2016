<?php
    /*
        This is a mysql class for query
     */
    class MM_Mysql_Class
    {
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

            // echo "<pre>" . print_r($this,true) . "<pre>" ;
        }

        # 連線
        private function connect()
        {
            $this -> mConnection = mysqli_connect(
                "127.0.0.1" ,
                'root',
                'root',
                'myBandown'
            );

            if (!$this -> mConnection)
            {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
            else
            {
                echo '資料庫已連線' . "<br>";
            }
        }

        # 下基本指令
        public function setQuery($_sql)
        {
            $_result = $this -> mConnection -> query($_sql);

            $output = array();

            while($row = $_result->fetch_assoc())
            {
                array_push($output , $row);
            }
            return $output;
        }
        # 插入資料
        public function insertQuery()
        {
            # dosomething.....
        }

        # 解構子
        public function __destruct()
        {
            mysqli_close($this -> mConnection);

            echo "資料庫已中斷連線" . "<br>";
        }


    }


?>
