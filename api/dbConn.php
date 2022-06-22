
<?php

class Conn
{
    private $host;
    private $user;
    private $pass;
    private $db;

    private $conn;
    // mysql://b41d2a89fb3b24:42df1f6b@eu-cdbr-west-02.cleardb.net/heroku_2e7391170fbe8e4?reconnect=true
    protected function connect()
    {
        $this->host = "42df1f6b@eu-cdbr-west-02.cleardb.net";
        $this->user = "b41d2a89fb3b24";
        $this->password = "42df1f6b";
        $this->db = "heroku_2e7391170fbe8e4";

        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $this->host = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->db = "cinterns";
        }

        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        $this->conn = $conn;
        return $this->conn;
    }

    protected function close()
    {
        $this->conn->close();
    }
}

