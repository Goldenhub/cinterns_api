<?php

include_once 'dbconn.php';


class GetIntern extends Conn
{
    private function listInterns()
    {
        $conn = $this->connect();

        $sql = "SELECT `id`, `name`, `email`, `school`, `major`, `city`, `state`, `country`, `github`, `linkedin`, `skills`, `experience`, `image` FROM interns ORDER BY id ASC";

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
        return $this->listInterns();
    }
}

$interns = new GetIntern();
echo $interns->result();
