<?php

include 'dbconn.php';

class Test extends Conn {
    public function result(){
        
        $this->connect();
        // $this->close();
    }
}

$run = new Test();
$run->result();


// print_r(parse_url(getenv("CLEARDB_DATABASE_URL")));

