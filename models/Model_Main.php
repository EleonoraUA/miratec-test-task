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
        if (!empty($_POST['first_name']) && !empty($_POST['email']) && $this->passwordsMatches()) {
            $mapperUser = new ModuleValidate_MapperUser($this->getConnection());
            $userId = $mapperUser->saveUser();
            if ($userId) {
                $res = $this->setAvatar($userId, $mapperUser);
                if ($res) return true;
            }
        }
    }

    private function passwordsMatches()
    {
        return ($_POST['password'] === $_POST['reenterPass']) ? true : false;
    }

    private function setAvatar($id, $mapperUser)
    {
        if (!file_exists('uploads/'.$id)) {
            mkdir('uploads/'.$id, 0777, true);
        }
        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $id . "/" . $_FILES["photo"]["name"]);
        $res = $this->scaleAndSave($id, $mapperUser);
        return $res;
    }

    private function scaleAndSave($id, $mapperUser)
    {
        //header('Content-Type: image/jpeg');
        $sizes = array(
            array(500, 500),
            array(150, 150),
            array(50, 50)
        );
        list($width, $height) = getimagesize("uploads/" . $id . "/" . $_FILES["photo"]["name"]);
        foreach ($sizes as $size) {
            header('Content-Type: image/jpeg');
            $thumb = imagecreatetruecolor($size[0], $size[1]);
            $source = imagecreatefromjpeg("uploads/" . $id . "/" . $_FILES["photo"]["name"]);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $size[0], $size[1], $width, $height);
            imagejpeg($thumb, "uploads/" . $id . "/" . $size[0]. "_" . $_FILES["photo"]["name"]);
        }
        $res = $mapperUser->savePhoto($id, $sizes);
        return $res;
    }
}