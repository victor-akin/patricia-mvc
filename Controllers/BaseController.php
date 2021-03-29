<?php

namespace Controllers;

use Views\View;

class BaseController
{
    public $handlers;
    public $view;

    public function __construct()
    {
        $this->handlers = [];
        $this->view = new View();
    }

    public function redirect($to = '')
    {
        $host = $_SERVER['HTTP_ORIGIN'];
        header("Location: $host/$to");
        exit();
    } 
}