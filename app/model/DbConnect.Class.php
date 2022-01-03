<?php
class DbConnect
{
    private static $db;

    public static function getDb()
    {
        return DbConnect::$db;
    }

    public static function init()
    {
        try {
            self::$db = new SQLite3(PATH_DB);
        } 
        catch (Exception $e) {
            die();
        }
    }
}
