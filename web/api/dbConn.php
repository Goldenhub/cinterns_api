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
        // $this->cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->cleardb_server = 'eu-cdbr-west-02.cleardb.net';
        $this->cleardb_username = 'b41d2a89fb3b24';
        $this->cleardb_password = '42df1f6b';
        $this->cleardb_db = 'heroku_2e7391170fbe8e4?reconnect=true';
        // $this->active_group = 'default';
        // $this->query_builder = TRUE;

        $this->conn = new mysqli($this->cleardb_server, $this->cleardb_username, $this->cleardb_password, $this->cleardb_db);
        // mysql://b41d2a89fb3b24:42df1f6b@eu-cdbr-west-02.cleardb.net/heroku_2e7391170fbe8e4?reconnect=true
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

