<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 10.02.2016
 * Time: 0:00
 */
class Model_Main extends Model
{
    function checkConnection()
    {
        return $this->db;
    }
}