<?php

    include_once 'dbconn.php';
    

    class Intern extends Conn {
        private function addInterns($admin, $name, $email, $school, $major, $city, $state, $country, $github, $linkedin, $skills, $experience, $image)
        {
            $conn = $this->connect();

            $sql = "INSERT INTO interns (
                admin,
                name, 
                email, 
                school, 
                major, 
                city, 
                state, 
                country, 
                github, 
                linkedin, 
                skills, 
                experience, 
                image
            ) VALUES ('$admin', '$name', '$email', '$school', '$major', '$city', '$state', '$country', '$github', '$linkedin', '$skills', '$experience', '$image')";

            $result = $conn->query($sql);
            if($result === true)
            {
                $this->close();
                return json_encode(array("statuscode" => 0, "data" => "Intern successfully added"));
            }
            else
            {
                $this->close();
                return json_encode(array("statuscode" => 1, "data" => "Error Adding Intern"));
            }
        }
        
        public function result()
        {
            if($_SESSION["isLoggedIn"] == true)
            {
                if($_FILES['image']['name']){
                    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$_FILES['image']['name']);
                    $image="uploads/".$_FILES['image']['name'];
                }
                $image = $_FILES['image']['name'];

                return $this->addInterns($_POST['userid'], $_POST['fullname'], $_POST['email'], $_POST['school'], $_POST['major'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['github'], $_POST['linkedin'], $_POST['skills'], $_POST['experience'], $image);
                
            }
        }
    }

    $intern = new Intern();
    session_start();
    echo $intern->result();
?>
