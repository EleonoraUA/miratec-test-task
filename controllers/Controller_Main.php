<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 09.02.2016
 * Time: 23:59
 */
class Controller_Main extends Controller
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    function action_index()
    {
        $this->view->generate('index.html');
    }

}