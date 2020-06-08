<?php


final class DB
{
    private static $dbh;

    public static function getInstance()
    {
        if (!self::$dbh) {
            $dsn = 'mysql:host=localhost;dbname=c1_atty';
            $user = 'c1_atty';
            $pass = '951149Alona';
            try {
                $dbh = new PDO($dsn, $user, $pass);
                self::$dbh = $dbh;
            } catch (PDOException $e) {
                echo 'Подключение к БД не удалось' . $e->getMessage();
            }
        }
        return self::$dbh;
    }

}