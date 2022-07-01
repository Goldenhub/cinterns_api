<?php
    $ds = DIRECTORY_SEPARATOR;
    $base_dir = dirname(__FILE__)  . $ds;
    require "{$base_dir}dbConn.php";
    // include './dbconn.php';

    class Auth extends Conn {
        private function login($username, $password)
        {
            $conn = $this->connect();
            $sql = "SELECT `id` as userid, `username` FROM users WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);
            $num_rows = $result->num_rows;
            if($num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
                $this->close();
                session_start();
                $_SESSION["isLoggedIn"] = true;
                return json_encode(array("statuscode" => 0, "data" => $data));
            }
            else
            {
                $this->close();
                return json_encode(array("statuscode" => 1, "data" => "No data found"));
            }
        }
        
        public function result($action)
        {
            if($action == 'login')
            {

                return $this->login($_POST['username'], $_POST['password']);
                
            }
        }
    }

    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $host = $cleardb_url["host"];
    $user = $cleardb_url["user"];
    $pass = $cleardb_url["pass"];
    $db = substr($cleardb_url["path"], 1);

    $auth = new Auth($host, $user, $pass, $db);

    echo $auth->result($_POST['action']);
