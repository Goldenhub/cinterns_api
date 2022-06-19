<?php

include_once 'dbconn.php';

class test extends Conn
{
    public function test()
    {
        $conn = $this->connect();

        $sql = "SELECT * FROM interns";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $this->close();
            return json_encode(array("statuscode" => 0, "status" => "request was successful", "data" => $data));
        } else {
            $this->close();
            return json_encode(array("statuscode" => 1, "status" => "request was successful", "data" => "No record found"));
        }
    }

    public function result()
    {
        return $this->test();
    }
}

$res = new test();
echo $res->result();
