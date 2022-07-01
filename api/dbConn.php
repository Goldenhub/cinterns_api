
<?php

class Conn
{
    // protected $cleardb_url;
    protected $host;
    protected $user;
    protected $pass;
    protected $db;

    protected $conn;

    public function __construct($host, $user, $pass, $db)
    {
        // $this->cleardb_url = $cleardb_url;
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
    }

    protected function connect()
    {
        // if ($_SERVER['HTTP_HOST'] != 'localhost') {
        //     $this->cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        //     $this->host = $this->cleardb_url["host"];
        //     $this->user = $this->cleardb_url["user"];
        //     $this->pass = $this->cleardb_url["pass"];
        //     $this->db = substr($this->cleardb_url["path"], 1);
        // } else {
        //     $this->host = 'localhost';
        //     $this->user = 'root';
        //     $this->pass = '';
        //     $this->db = 'cinterns';
        // }


        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        $this->conn = $conn;

        return $this->conn;
    }

    protected function close()
    {
        $this->conn->close();
    }
}
