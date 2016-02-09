<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 09.02.2016
 * Time: 23:30
 */
class Database
{
    public static $db;

    public static function getConnection()
    {
        if (!self::$db) {
            self::$db = new PDO('mysql:host=localhost;dbname=users', 'root', '12345');
        }
        return self::$db;
    }
}