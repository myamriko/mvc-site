<?php


final class DB
{
    private static $dbh;

    public static function getInstance()
    {
        if (!self::$dbh) {
            $dsn = 'mysql:host=localhost;dbname=c13mvc_sity';
            $user = 'c7mvc_site';
            $pass = '951149Alona';
            try {
                $dbh = new PDO($dsn, $user, $pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"]);// для того чтобы убрать в линуксе ???????? [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"]
                self::$dbh = $dbh;
            } catch (PDOException $e) {
                echo 'Подключение к БД не удалось' . $e->getMessage();
            }
        }
        return self::$dbh;
    }

}