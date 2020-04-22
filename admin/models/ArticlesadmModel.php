<?php


class ArticlesadmModel
{
    const CACHE_KEY = 'article-site';
    public $id;
    public $start;
    public $limit;
    public $page;


    public function all()
    {
         $siteData = InfoModel::info();
         $expire = $siteData['cechetime'];
         $cacheKey = self::CACHE_KEY . '-panel-'.$this->page;
         $cachedArticle = Cache::get($cacheKey);
         if ($cachedArticle) {
             return $cachedArticle;
         }
        $query = 'SELECT `art`.`id`,`art`.`title`,`art`.`url`,`art`.`intro`,`cat`.`name`,`art`.`category`,`art`.`tags`,`art`.`file`,`art`.`alt`,`art`.`date`, `art`.`author`, `art`.`published`, `art`.`front` FROM `articles` AS `art` LEFT JOIN `categories` AS `cat` ON `art`.`category`=`cat`.`url` ORDER BY `date` DESC LIMIT '.$this->start.', '.$this->limit.'';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $articles = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $articles, $expire);
        return $articles;
    }

    public function add($data)
    {
        $query = 'INSERT INTO `articles`(`title`, `intro`, `text`, `tags`, `category`, `file`, `alt`, `url`, `author`, `published`, `front`) VALUES (:title, :intro, :text, :tags, :category, :file, :alt, :url, :author, :published, :front)';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':title' => $data['title'], ':intro' => $data['intro'], ':text' => $data['text'], ':tags' => $data['tags'], ':category' => $data['category'], ':file' => $data['file'], ':alt' => $data['alt'], ':url' => $data['url'], ':author' => $data['author'], ':published' => $data['published'], ':front' => $data['front']]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
       // Cache::forget(self::CACHE_KEY . '-panel');//очистить кеш
        return $dbh->lastInsertId();
    }

    public function edit($data)
    {
        $query = 'UPDATE `articles` SET `title`=:title, `intro`=:intro, `text`=:text, `tags`=:tags, `category`=:category, `file`=:file, `alt`=:alt, `url`=:url, `author`=:author, `published`=:published, `front`=:front WHERE `id` = :id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':title' => $data['title'], ':intro' => $data['intro'], ':text' => $data['text'], ':tags' => $data['tags'], ':category' => $data['category'], ':file' => $data['file'], ':alt' => $data['alt'], ':url' => $data['url'], ':author' => $data['author'], ':published' => $data['published'], ':front' => $data['front'], ':id' => $data['id']]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
     //   Cache::forget(self::CACHE_KEY . '-panel');//очистить кеш
        return (bool)$res->rowCount();

    }

    public function removed()
    {
        $query = "DELETE FROM `articles` WHERE `id`= :id LIMIT 1";
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
      //  Cache::forget(self::CACHE_KEY . '-panel');//очистить кеш
        return (bool)$res->rowCount();
    }

    public function getArticle()
    {
        $query = 'SELECT `art`.`id`,`art`.`title`,`art`.`url`,`art`.`intro`,`art`.`text`,`cat`.`name`,`art`.`category`,`art`.`tags`,`art`.`file`,`art`.`alt`,`art`.`date`, `art`.`author`, `art`.`published`, `art`.`front` FROM `articles` AS `art` LEFT JOIN `categories` AS `cat` ON `art`.`category`=`cat`.`url` WHERE `art`.`id` = :id';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        $article = $res->fetch(PDO::FETCH_ASSOC);
        return $article;
    }


}