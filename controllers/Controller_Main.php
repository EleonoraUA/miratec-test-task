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
        $this->model = new Model_Main(); //creates model
        $this->view = new View(); // and view for controller
    }

    function action_index()
    {
        if (isset($_SESSION)) session_destroy();
        $this->view->generate('index.html'); // show main form
    }

    function action_validate()
    {
        if (!$this->model->validateAndSaveData()) { // validate and save data into database
            echo "Form is not valid and didn't save!";
        } else {
            header("Location: ../profile"); // go to profile if success
        }
    }

    function action_profile()
    {
        $data = $this->model->getProfile();
        if ($data) { // shiw profile if user is registered
            $this->view->generate('profile.html', $data);
        } else { // show error in the other case
            $this->view->generate('error.html');
        }
    }

}