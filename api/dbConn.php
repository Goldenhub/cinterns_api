
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
        $cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->host = $cleardb_url["host"];
        $this->user = $cleardb_url["user"];
        $this->password = $cleardb_url["pass"];
        $this->db = substr($cleardb_url["path"],1);

        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $this->host = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->db = "cinterns";
        }

        try{

            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
            $this->conn = $conn;
            return $this->conn;
        }catch(Exception $e){
            var_dump(phpinfo());
            echo "Error: " . $e->getMessage();
        }

    }

    protected function close()
    {
        $this->conn->close();
    }
}

