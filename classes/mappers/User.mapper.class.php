<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 10.02.2016
 * Time: 14:57
 */
class ModuleValidate_MapperUser
{
    protected $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function saveUser()
    {
        $allowed = array('first_name', 'last_name', 'patronymic', 'email', 'phone', 'password');
        $sql = "INSERT INTO user SET " . $this->insertPDO($allowed, $values);
        $res = $this->db->prepare($sql)->execute($values);
        if ($res) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function savePhoto($id, $sizes)
    {
        $avatar_type = '';
        $user_id = '';
        $file_name = '';
        $sql = $this->db->prepare("INSERT INTO avatars (pixels, user_id, file_name) VALUES (:pixels, :user_id, :file_name)");
        $sql->bindParam(':pixels', $avatar_type);
        $sql->bindParam(':user_id', $user_id);
        $sql->bindParam(':file_name', $file_name);
        $user_id = $id;
        foreach ($sizes as $size) {
            $avatar_type = $size[0];
            $file_name = "uploads/" . $id . "/" .  $size[0]. "_" . $_FILES["photo"]["name"];
            $sql->execute();
        }
        return $sql;
    }

    public function getProfileData()
    {
        $user_sql = $this->db->prepare("SELECT first_name, last_name, patronymic, email, phone FROM user WHERE user_id = " . $_SESSION['user_id']);
        $photo_sql = $this->db->prepare("SELECT file_name, pixels FROM avatars WHERE user_id = " . $_SESSION['user_id']);
        $user_sql->execute();
        $photo_sql->execute();
        // set the resulting array to associative
        $user_sql->setFetchMode(PDO::FETCH_ASSOC);
        $photo_sql->setFetchMode(PDO::FETCH_ASSOC);
        return array_merge($user_sql->fetch(), array("photos" => $photo_sql->fetchAll()));
    }

    private function insertPDO($allowed, &$values, $source = array())
    {
        $set = '';
        $values = array();
        if (!$source) $source = &$_POST;
        foreach ($allowed as $field) {
            if (isset($source[$field])) {
                $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
                $values[$field] = $source[$field];
            }
        }
        return substr($set, 0, -2);
    }
}