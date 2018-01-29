<?php 
    class db {
        //properties
        private $dbhost = 'shhzdecpa1.dihostnet.com';
        private $dbuser = 'lucicpoe_mijo';
        private $dbpass = 'jfYd7Y7s58';
        private $dbname = 'lucicpoe_baza';

        public function connect() {
            $mysql_connect_string = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_string, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }