<?php

namespace Controllers;

class ErrorController extends BaseController
{
    public function notFound()
    {
        $this->view->render('404.html');
    }
}