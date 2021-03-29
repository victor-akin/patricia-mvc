<?php

namespace Views;

class View{

    public $data = "from view";
    
    public function render($view_file)
    {
        $public_path = __DIR__.'/../public/';

        $d = $this->data;

        if(file_exists($public_path.$view_file)){
            include $public_path.$view_file;
        }
    }

}