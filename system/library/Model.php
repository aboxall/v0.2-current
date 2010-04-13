<?php

class Model extends PDOStatement
{
    public $db;

    public function __construct()
    {
        $this->db = Load::library('DB');
    }
}

// EOF
