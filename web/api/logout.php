<?php


class LogoutAdmin {
    private function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        return json_encode(array("statuscode" => 0, "data" => "Logged out"));
    }

    public function result()
    {
        
        return $this->logout();
    }
}


$logout = new LogoutAdmin();

echo $logout->result();

?>