<?php
    class dbObj
    {
        private $dbhost = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "banco de dados cdz";

        public $con;

    
        function getConnstring() {
            $con = new mysqli($this->dbhost, $this->username, $this->password, $this->dbname);
            
            /* check connection */
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            } else {
                $this->con = $con;
            }
            return $this->con;
        }
        public function query( $query ) 
        {
            return mysqli_query($this->con , $query);     
        }

        public function quit()
        {
            mysqli_close($this->con);
        }
    }

?>