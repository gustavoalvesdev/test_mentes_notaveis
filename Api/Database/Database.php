<?php 

namespace Api\Database;

class Database
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new \PDO(
                DBDRIVER . ':host=' .
                DBHOST . ';dbname=' .
                DBNAME,
                DBUSER,
                DBPASS
            );
        }

        return self::$instance;
    }

    private function __construct() {}
}
