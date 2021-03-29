<?php

require_once './Helpers/DB.php';

$config = parse_ini_file('./config.ini');

$db_dir = __DIR__.'/za_db/';

$db = new \Helpers\DB();

$files = scandir($db_dir);

if($argc > 1 && $argv[1] === "--drop"){ // dropping tables

    $db->query("SHOW TABLES");
    $tables = $db->resultset();
    
    foreach($tables as $table_obj){
        $table_name = array_values((array)$table_obj);
        if(count($table_name) == 1){
            $db->query("DROP TABLE $table_name[0]");
            
            if($db->execute()) echo "\e[31m$table_name[0]" . " deleted \n";
        }
    }

    return;
}

foreach($files as $file){
    if(!is_file($db_dir.$file)) continue;

    $sql = file_get_contents($db_dir.$file);
    $db->query($sql);
    if($db->execute()) echo "\e[92m$file ✓\n";
}



