<?php

namespace Models;

use Helpers\DB;

class Model
{
    public $DB;

    public function __construct()
    {
        $this->DB = new DB();
    }
}