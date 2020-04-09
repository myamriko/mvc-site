<?php


class ArticlesModel
{
    const CECHE_KEY = 'article-site';


    public function all()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CECHE_KEY;
        $cachedArticle = Cache::get($cacheKey);
        if ($cachedArticle) {
            return $cachedArticle;
        }
        $query = 'SELECT * FROM `articles`';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $articles = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $articles, $expire);
        return $articles;
    }
}