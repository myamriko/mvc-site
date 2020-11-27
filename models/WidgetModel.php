<?php


class WidgetModel
{
    const CACHE_KEY = 'widget';

    public static function lastArticle()
    {

        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY.'-last_Article';
        $cachedArticle = Cache::get($cacheKey);
        if ($cachedArticle) {
            return $cachedArticle;
        }
        $query = 'SELECT * FROM `articles` order by `id` desc LIMIT 3';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $lastArticle = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $lastArticle, $expire);
        return $lastArticle;

    }

    public static function lastComments($category)
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY.'-last_Comments'.'-'.$category;
        $cachedComments = Cache::get($cacheKey);
        if ($cachedComments) {
            return $cachedComments;
        }

        $query = 'SELECT `com`.`id`, `com`.`username`,`com`.`mess`,`com`.`article_id`, `art`.`url`, `art`.`id`, `art`.`category`  FROM   `comments`  AS `com` LEFT JOIN `articles` AS `art` ON `com`.`article_id` = `art`.`id` WHERE `art`.`category` = "'.$category.'" order by `com`.`id` desc LIMIT 3';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $lastComments = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $lastComments, $expire);
        return $lastComments;
    }

}