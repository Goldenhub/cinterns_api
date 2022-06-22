
<?php

class Conn
{
    private $cleardb_url;
    private $host;
    private $user;
    private $pass;
    private $db;
    private $active_group;
    private $query_builder;

    private $conn;

    protected function connect()
    {
        if($_SERVER['HTTP_HOST'] != 'localhost'){
            $this->cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $this->host = $this->cleardb_url["host"];
            $this->user = $this->cleardb_url["user"];
            $this->pass = $this->cleardb_url["pass"];
            $this->db = substr($this->cleardb_url["path"],1);
            $this->active_group = 'default';
            $this->query_builder = TRUE;
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

