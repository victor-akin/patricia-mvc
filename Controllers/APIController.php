<?php

namespace Controllers;

use Helpers\DB;

class APIController
{
    private $status = 200;
    
    private $data = [];

    public $handlers = [
        'post' => [
            'default' => 'saveSomething'
        ],
        'get' => [
            'default' => 'getUsers'
        ]
    ]; 

    public function response()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $uri_params = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($uri_params);
        $handler = count($uri_params) > 1 && !empty($uri_params[1]) ? $uri_params[1] : 'default';

        if(!$this->_handlerExists($method, $handler)) $this->_errorResponse(404, "Resource does not exist");
        
        call_user_func([$this, $this->handlers[$method][$handler]]);

        echo json_encode([
            'status_code' => $this->status,
            'data' => $this->data
        ]);
    }

    public function saveSomething()
    {
        // after operation

        $this->status = 200;
        $this->data['message'] = "Saved data";
    }

    public function getUsers()
    {
        $db = new DB();

        $db->query("SELECT fullname, email FROM users");
        if($db->execute()){
            $this->status = 200;
            $this->data['res'] = $db->resultset();
        } else {
            $this->status = 400;
            $this->data['res'] = [];
        }
    }

    private function _handlerExists($method, $handler)
    {
        return isset($this->handlers[$method]) && isset($this->handlers[$method][$handler]) ? true : false;
    }

    private function _errorResponse($status_code, $message)
    {
        $this->status = $status_code;
        $this->data['message'] = $message;
    }
}