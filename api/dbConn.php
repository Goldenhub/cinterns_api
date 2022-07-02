
<?php

class Conn
{    
    protected $host;
    protected $user;
    protected $pass;
    protected $db;

    protected $conn;

    public function __construct()
    {
        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->host = $cleardb_url["host"];
        $this->user = $cleardb_url["user"];
        $this->pass = $cleardb_url["pass"];
        $this->db = substr($cleardb_url["path"], 1);
    }

    protected function connect()
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        $this->conn = $conn;

        return $this->conn;
    }

    protected function close()
    {
        $this->conn->close();
    }
}
