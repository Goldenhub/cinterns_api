<?php

    include_once 'dbconn.php';

    class AdminConfirm extends Conn {
        private function confirm($username, $userid)
        {
            $conn = $this->connect();
            $sql = "SELECT `id` as userid, `username` FROM users WHERE username = '$username' AND id = '$userid'";
            $result = $conn->query($sql);
            $num_rows = $result->num_rows;
            if($num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
                $this->close();                
                return json_encode(array("statuscode" => 0, "data" => $data, "status" => "Admin Logged In"));
            }
            else
            {
                $this->close();
                return json_encode(array("statuscode" => 1, "status" => "No records found"));
            }
        }
        
        public function result()
        {
            if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true)
            {
                return json_encode(array("statuscode" => 1, "status" => "Session timed out or invalid userid"));
            }
            return $this->confirm($_POST['username'], $_POST['userid']);
            
        }
    }

    $admincon = new AdminConfirm();
    session_start();
    echo $admincon->result();

