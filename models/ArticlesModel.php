<?php


class ArticlesModel
{
    const CACHE_KEY = 'article-site';


    public function all()// доля autoload при поиске в articleadm
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY;
        $cachedArticle = Cache::get($cacheKey);
        if ($cachedArticle) {
            return $cachedArticle;
        }
        $query = 'SELECT * FROM `articles` ORDER BY `date` DESC';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $articles = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $articles, $expire);
        return $articles;
    }

}