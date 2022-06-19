<?php
//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// create connection
class Conn
{
    private $cleardb_url;
    private $cleardb_server;
    private $cleardb_username;
    private $cleardb_password;
    private $cleardb_db;
    private $active_group;
    private $query_builder;

    private $conn;

    protected function connect()
    {
        $this->cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->cleardb_server = $this->cleardb_url["host"];
        $this->cleardb_username = $this->cleardb_url["user"];
        $this->cleardb_password = $this->cleardb_url["pass"];
        $this->cleardb_db = substr($this->cleardb_url["path"], 1);
        $this->active_group = 'default';
        $this->query_builder = TRUE;

        $conn = new mysqli($this->cleardb_server, $this->cleardb_username, $this->cleardb_password, $this->cleardb_db);

        $this->conn = $conn;
        return $this->conn;
    }

    protected function close()
    {
        $this->conn->close();
    }
}
