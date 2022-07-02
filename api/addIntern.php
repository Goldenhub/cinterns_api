<?php

$ds = DIRECTORY_SEPARATOR;
$homedir = dirname(dirname(__FILE__)) . $ds;
require "{$homedir}vendor/autoload.php";

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance(getenv("CLOUDINARY_URL"));

// $config->cloud->cloudName = 'hgbhmxa9v';
// $config->cloud->apiKey = '825992268422223';
// $config->cloud->apiSecret = '9fdFIjbcscxnJrxqIWrmEmGd7us';
// $config->url->secure = true;
// $cloudinary = new Cloudinary($config);


$base_dir = dirname(__FILE__)  . $ds;
require_once "{$base_dir}dbConn.php";

class Intern extends Conn
{
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
        if ($result === true) {
            $this->close();
            return json_encode(array("statuscode" => 0, "data" => "Intern successfully added"));
        } else {
            $this->close();
            return json_encode(array("statuscode" => 1, "data" => "Error Adding Intern"));
        }
    }

    public function result()
    {
        $ds = DIRECTORY_SEPARATOR;
        $home_dir = dirname(dirname(__FILE__)) . $ds;

        if ($_SESSION["isLoggedIn"] == true) {
            if ($_FILES['image']['name']) {
                $upload = new UploadApi();
                echo '<pre>';
                echo json_encode(
                    $upload->upload('https://res.cloudinary.com/demo/image/upload/flower.jpg', [
                        'public_id' => 'flower_sample',
                        'use_filename' => TRUE,
                        'overwrite' => TRUE
                    ]),
                    JSON_PRETTY_PRINT
                );
                // move_uploaded_file($_FILES['image']['tmp_name'], $home_dir . "uploads/" . $_FILES['image']['name']);
                $upload->upload($_FILES['image']['tmp_name'], [
                    'public_id' => $_FILES['image']['name'],
                    'use_filename' => TRUE,
                    'overwrite' => TRUE
                ]);
                $image = $_FILES['image']['name'];
            }
            // $image = $_FILES['image']['name'];

            return $this->addInterns($_POST['userid'], $_POST['fullname'], $_POST['email'], $_POST['school'], $_POST['major'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['github'], $_POST['linkedin'], $_POST['skills'], $_POST['experience'], $image);
        }
    }
}

$intern = new Intern();
session_start();
echo $intern->result();
