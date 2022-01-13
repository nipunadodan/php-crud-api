<?php
namespace Orange;
use Medoo\Medoo;
use PDO;

class Db extends Medoo{
    public function __construct(){
        $option = array(
            'database_type' => 'mysql',
            'database_name' => DB,
            'server' => DB_HOST,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'prefix' => DB_PREFIX,
            'charset' => 'utf8',
            'error' => PDO::ERRMODE_EXCEPTION
        );
        parent::__construct($option);
    }
}