<?php 
    class Database {
        private $connection;
        public function __construct() {
            $db = $this -> getCredentials();
            $this -> connection = mysqli_connect($db["host"],$db["user"],$db["password"],$db["name"]);
        }
        private function getCredentials() {
            $credentials = array();
            $credentials["user"] = getenv("dbuser");
            $credentials["password"] = getenv("dbpassword");
            $credentials["name"] = getenv("dbname");
            $credentials["host"] = getenv("dbhost");
            return $credentials;
        }
        protected function getConnection() { //protected because classes that don't need to access the connection don't need to see the function
            if($this->connection) {
                return $this->connection;
            }
            else {
                error_log("database connection failed",0);
                return false;
            }
        }
    }
?>