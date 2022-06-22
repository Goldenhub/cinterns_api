
<?php

class Conn
{
    protected $cleardb_url;
    protected $host;
    protected $user;
    protected $pass;
    protected $db;
    protected $active_group;
    protected $query_builder;

    protected $conn;

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

