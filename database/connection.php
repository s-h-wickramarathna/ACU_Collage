<?php

class Database
{

    public static $connection;

    public static function SetupConnection()
    {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "Heashan@655", "student_management_system", "3306");
        }
    }

    public static function iud($q)
    {
        Database::SetupConnection();
        Database::$connection->query($q);
    }

    public static function Search($q){
        Database::SetupConnection();
        $resultSet = Database::$connection->query($q);
        return $resultSet;
    }

}
