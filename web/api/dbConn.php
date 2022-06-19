<?php

// create connection
class Conn
{
    
    private $cleardb_url;
    private $cleardb_server;
    private $cleardb_username;
    private $cleardb_password;
    private $cleardb_db;
    // private $active_group;
    // private $query_builder;
    private $conn;

    function __construct()
    {
        $this->cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->cleardb_server = $this->cleardb_url["host"];
        $this->cleardb_username = $this->cleardb_url["user"];
        $this->cleardb_password = $this->cleardb_url["pass"];
        $this->cleardb_db = substr($this->cleardb_url["path"], 1);
        // $this->active_group = 'default';
        // $this->query_builder = TRUE;

        $this->conn = new mysqli($this->cleardb_server, $this->cleardb_username, $this->cleardb_password, $this->cleardb_db);
        
    }


    protected function connect()
    {
        return $this->conn;
    }

    protected function close()
    {
        $this->conn->close();
    }
}

