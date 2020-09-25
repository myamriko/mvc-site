<?php


class ArticlesModel
{
    const CACHE_KEY = 'article-site';

    public $start;
    public $limit;
    public $page;


    public function article($url)
    {
    $query = 'SELECT * FROM `articles` WHERE `url` = :url';
    $dbh = DB::getInstance();
    $res =$dbh->prepare($query);
    $res -> execute([':url' => $url]);
    $articles = $res->fetch(PDO::FETCH_ASSOC);
    return $articles;
    }

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

    public function category($category)// доля autoload при поиске в articleadm
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY . '-' . $category . '-' . $this->page;
        $cachedArticle = Cache::get($cacheKey);
        if ($cachedArticle) {
            return $cachedArticle;
        }
        $query = 'SELECT * FROM `articles` WHERE `category`=:category && `published`=:published LIMIT ' . $this->start . ', ' . $this->limit . '';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':category' => $category, ':published' => 'ON']);
        $articles = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $articles, $expire);
        return $articles;
    }

    public function tag($category)// доля autoload при поиске в articleadm
    {
        $category = '%' . $category . '%';
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY . '-' . $category . '-' . $this->page;
        $cachedArticle = Cache::get($cacheKey);
        if ($cachedArticle) {
            return $cachedArticle;
        }
        $query = 'SELECT * FROM `articles` WHERE `tags` LIKE :category && `published`=:published LIMIT ' . $this->start . ', ' . $this->limit . '';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':category' => $category, ':published' => 'ON']);
        $articles = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $articles, $expire);
        return $articles;
    }

}