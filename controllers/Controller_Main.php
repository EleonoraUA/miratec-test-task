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
        if (isset($_SESSION)) session_destroy();
        $this->view->generate('index.html');
    }

    function action_validate()
    {
        if (!$this->model->validateAndSaveData()) {
            echo "Form is not valid and didn't save!";
        } else {
            header("Location: ../profile");
        }
    }

    function action_profile()
    {
        $data = $this->model->getProfile();
        if ($data) {
            $this->view->generate('profile.html', $data);
        } else {
            $this->view->generate('error.html');
        }
    }

}