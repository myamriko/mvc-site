<?php


final class InfoModel
{
    use ResponseTrait;
    private static $res;
    const CACHE_KEY = 'info-site';
    private $cechetime;

    /**
     * @return false|mixed|PDOStatement|null
     * все данные сайта info сайта
     */
    public static function info()
    {
        $cacheKey = self::CACHE_KEY;
        $cachedInfo = Cache::get($cacheKey);
        if ($cachedInfo) {
            return $cachedInfo;
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

    public static function front()
    {
        $cacheKey = self::CACHE_KEY.'-frontContent';
        $cachedContentFront = Cache::get($cacheKey);
        if ($cachedContentFront) {
            return $cachedContentFront;
        }
        $dbh = DB::getInstance();
        $query = 'SELECT * FROM `paginas` WHERE `name` = "front" ORDER BY `id` ASC';
        $res = $dbh->query($query);
        $contentFront = $res->fetchAll(PDO::FETCH_ASSOC);
        $expire = new self();// сздаем класс Sitedata
        $expire = $expire::info();
        $expire = $expire['cechetime']; // извлекаем из базы время жизни кеша
        Cache::set($cacheKey, $contentFront, $expire);
        return $contentFront;
    }

}