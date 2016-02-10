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

    public function validateFormData()
    {
        if (!empty($_POST['first_name']) && !empty($_POST['email']) && $this->passwordsMatches()) {
            $mapperUser = new ModuleValidate_MapperUser($this->getConnection());
            if ($mapperUser->saveUser()) {
                $this->setAvatar();
            }
        }
    }

    private function passwordsMatches()
    {
        return ($_POST['password'] === $_POST['reenterPass']) ? true : false;
    }

    private function setAvatar()
    {
        if (!file_exists('path/to/directory')) {
            mkdir('uploads/', 0777, true);
            move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $_FILES["photo"]["name"]);
        }
    }
}