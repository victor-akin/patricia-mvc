<?php

namespace Controllers;

use Models\UserModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->handlers = [
            ''      => 'index',
            'test'  => 'testPage'
        ];
    }

    public function index()
    {
        return $this->view->render('home.php');
    }

    public function testPage($with_params = [])
    {
        var_dump($with_params);
    }


}