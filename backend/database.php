<?php
    class Database {
        public $connection;
        function __construct($host, $username, $password, $database) {
            $this->connection = new mysqli($host, $username, $password, $database) or die("Connection failed : %s\n" . $this->connection -> error);
        }
    }
?>