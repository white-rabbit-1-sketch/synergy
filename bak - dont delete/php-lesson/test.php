<?php



// Singletone
class DbConnection
{
    protected static $instance;

    private function __construct()
    {

    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance =  new self();
        }

        return self::$instance;
    }
}

$connection1 = DbConnection::getInstance();
$connection2 = DbConnection::getInstance();
$connection3 = DbConnection::getInstance();

var_dump($connection1, $connection2, $connection3);