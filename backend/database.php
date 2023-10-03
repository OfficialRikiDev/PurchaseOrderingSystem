<?php
    class Database {
        public $connection;
        function __construct($host, $username, $password, $database) {
            $this->connection = new mysqli($host, $username, $password, $database) or die("Connection failed : %s\n" . $this->connection -> error);
            $this->connection->set_charset("utf8");
            if (mysqli_connect_errno()) {
                trigger_error("Problem with connecting to database.");
            }
        }
    }
?>