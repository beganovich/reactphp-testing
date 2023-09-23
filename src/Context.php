<?php

namespace App;

class Context
{
    public \SQLite3 $database;

    public function __construct()
    {
        $this->database = new \SQLite3('/tmp/php.sqlite');
    }
}
