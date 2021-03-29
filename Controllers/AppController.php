<?php

namespace Controllers;

class AppController
{
    public function __construct()
    {

    }

    public function router()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri_params = explode('/', $uri);

        $controller = $this->_getController($uri_params[1]);

        $controller = new $controller();

        if($controller instanceof APIController) return $controller->response();
        
        if($controller instanceof ErrorController) return $controller->notFound();
        
        $uri_handler = isset($uri_params[2]) ? $uri_params[2] : '';

        $uri_args = count($uri_params) > 3 ? array_slice($uri_params, 3) : [];

        if(!isset($controller->handlers[$uri_handler])) return (new ErrorController)->notFound();

        $controller_method = $controller->handlers[$uri_handler];

        $function_params = (new \ReflectionMethod($controller, $controller_method))->getParameters();

        $method_args = [];

        foreach($function_params as $idx => $arg){
            if(isset($uri_args[$idx+2])){
                $method_args[$arg->name] = $uri_args[$idx];
            } else {
                $method_args[$arg->name] = $arg->getDefaultValue();
            }
        }

        session_start();

        call_user_func_array([$controller, $controller_method], $method_args);        
    }
    
    private function _getController($controller)
    {
        $controller = ($controller == "") ? "Home" : ucfirst($controller); // default to HomeController
        $controller_file = __DIR__.'\\'.$controller."Controller.php";
        $controller_file = str_replace('\\', DIRECTORY_SEPARATOR, $controller_file);
        
        if(file_exists($controller_file)) return "Controllers\\".$controller."Controller";

        return "Controllers\ErrorController";
    }
}