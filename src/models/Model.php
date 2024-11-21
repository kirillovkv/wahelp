<?php

require_once __DIR__ .'/../config/db.php';

class Model
{
    public $db;

    public function __construct()
    {
        $this->db = Database::getDb();
    }
}