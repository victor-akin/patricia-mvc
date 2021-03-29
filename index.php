<?php

use Controllers\AppController;

spl_autoload_register(function($className) {
    $is_namespaced = explode(DIRECTORY_SEPARATOR, $className);
    $className = count($is_namespaced) > 1 ? array_pop($is_namespaced) : $className;
    
    preg_match('/(Controller)|(Model)|(View)|(Helper)/', $className, $matches);
    
    if(count($matches) == 0){ // might be a helper class
        $helper_classes = [
            "DB" => true,
            "SessionHelper" => true
        ];

        if(isset($helper_classes[$className])) $matches[0] = 'Helper';
    }

    $file = dirname(__FILE__) . "/$matches[0]s/" . $className . '.php'; 
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    
    if(file_exists($file)) include $file;
});


$app = new AppController();

$app->router();