<?php

namespace Models;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function exists($column, $value)
    {
        $this->DB->query("SELECT * FROM users WHERE $column = :key_value");
        $this->DB->bindParams([':key_value' => $value]);
        
        $res = $this->DB->getSingle();

        return $this->DB->rowCount() > 0 ? $res : false;
    }

    public function create($data)
    {
        $this->DB->query("INSERT INTO users (fullname, email, password) VALUES (:fullname, :email, :password)");

        $this->DB->bindParams([
            ':fullname' => $data['fullname'],
            ':email' => $data['email'],
            ':password' => $data['password']
        ]);

        return $this->DB->lastInsertId();
    }

}