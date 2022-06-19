<?php

    // create connection
    class Conn {
        private $host;
        private $user;
        private $pass;
        private $db;

        private $conn;

        protected function connect()
        {
            $this->host = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->db = "cinterns";

            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

            $this->conn = $conn;
            return $this->conn;
       }

       protected function close()
       {
            $this->conn->close();
       }
    }