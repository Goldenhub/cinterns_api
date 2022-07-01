<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = dirname(__FILE__)  . $ds;
require_once "{$base_dir}dbConn.php";


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
            return json_encode(array("statuscode" => 0, "status" => "request was successful", "data" => "No record found"));
        }
    }

    public function result()
    {
        return $this->listInterns();
    }
}

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$host = $cleardb_url["host"];
$user = $cleardb_url["user"];
$pass = $cleardb_url["pass"];
$db = substr($cleardb_url["path"], 1);

$interns = new GetIntern($host, $user, $pass, $db);
echo $interns->result();
