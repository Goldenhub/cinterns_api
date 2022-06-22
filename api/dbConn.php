
<?php

class Conn
{
    private $host;
    private $user;
    private $pass;
    private $db;

    private $conn;
    
    protected function connect()
    {
        if($_SERVER['HTTP_HOST'] != 'localhost'){
            $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $this->host = $cleardb_url["host"];
            $this->user = $cleardb_url["user"];
            $this->pass = $cleardb_url["pass"];
            $this->db = substr($cleardb_url["path"],1);
        }else{
            $this->host = 'localhost';
            $this->user = 'root';
            $this->pass = '';
            $this->db = 'cinterns';
        }

        try{

            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
            $this->conn = $conn;
        }catch(Exception $e){
            var_dump(phpinfo());
            echo "Error: " . $e->getMessage();
            die();
        }
        return $this->conn;

    }

    protected function close()
    {
        $this->conn->close();
    }
}

