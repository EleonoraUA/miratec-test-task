<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 10.02.2016
 * Time: 0:00
 */

require_once 'classes/mappers/User.mapper.class.php';

class Model_Main extends Model
{
    private function getConnection()
    {
        return $this->db;
    }

    public function validateAndSaveData()
    {
        if (!empty($_POST['first_name']) && !empty($_POST['email']) && $this->passwordsMatches()) { // check valid data
            $mapperUser = new ModuleValidate_MapperUser($this->getConnection());
            $userId = $mapperUser->saveUser(); // save user and return his id
            if ($userId) {
                if (!empty($_FILES['photo'])) {
                    $this->setAvatar($userId, $mapperUser); // set user avatar
                }
                session_start();
                $_SESSION['user_id'] = $userId;
                return true;
            }
        }
    }

    public function getProfile()
    {
        $data = array();
        session_start();
        if (!empty($_SESSION)) {
            $mapperUser = new ModuleValidate_MapperUser($this->getConnection());
            $data = $mapperUser->getProfileData(); // return user profile data
        } else {
            $data = false; // case when user is not registered
        }
        return $data;
    }

    private function passwordsMatches() // hash passwords and compare it
    {
        $_POST['password'] = md5($_POST['password']);
        $_POST['reenterPass'] = md5($_POST['reenterPass']);
        return ($_POST['password'] === $_POST['reenterPass']) ? true : false;
    }

    private function setAvatar($id, $mapperUser) // save uploaded file to the server
    {
        if (!file_exists('uploads/' . $id)) {
            mkdir('uploads/' . $id, 0777, true);
        }
        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $id . "/" . $_FILES["photo"]["name"]);
        $res = $this->scaleAndSave($id, $mapperUser);
        return $res;
    }

    private function scaleAndSave($id, $mapperUser) // scale the photo  and save in different sizes
    {
        //header('Content-Type: image/jpeg');
        $sizes = array(
            array(500, 500),
            array(150, 150),
            array(50, 50)
        );
        list($width, $height) = getimagesize("uploads/" . $id . "/" . $_FILES["photo"]["name"]);
        foreach ($sizes as $size) {
            //header('Content-Type: image/jpeg');
            $thumb = imagecreatetruecolor($size[0], $size[1]);
            $source = imagecreatefromjpeg("uploads/" . $id . "/" . $_FILES["photo"]["name"]);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $size[0], $size[1], $width, $height);
            imagejpeg($thumb, "uploads/" . $id . "/" . $size[0] . "_" . $_FILES["photo"]["name"]);
        }
        $res = $mapperUser->savePhoto($id, $sizes); // save to database
        return $res;
    }
}