<?php


final class Sitedata
{
    use ResponseTrait;
    private static $res;
    const CECHE_KEY = 'info-site';


    /**
     * @return false|mixed|PDOStatement
     * все данные сайта info сайта
     */
    public static function info()
    {
        $cacheKey = self::CECHE_KEY;
        $cachedItems = Cache::get($cacheKey);
        if ($cachedItems) {
            return $cachedItems;
        }
        $dbh = DB::getInstance();
        $query = 'SELECT * FROM `info-site`';
        $res = $dbh->query($query);
        $res = $res->fetch(PDO::FETCH_ASSOC);
        $expire = new self();// сздаем класс Sitedata
        $expire->cechetime = $res['cechetime']; // извлекаем из базы время жизни кеша
        Cache::set($cacheKey, $res, $expire->cechetime);
        return $res;
    }

}