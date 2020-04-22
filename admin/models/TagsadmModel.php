<?php


class TagsadmModel
{
    const CACHE_KEY = 'tags-site';
    public $tag;
    public $id;
    public $url;
    public $start;
    public $limit;
    public $page;

    public function all()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY.'-'.$this->page;
        $cachedTags = Cache::get($cacheKey);
        if ($cachedTags) {
            return $cachedTags;
        }
        $query = 'SELECT * FROM `tags`  ORDER BY `id` DESC LIMIT '.$this->start.', '.$this->limit.'';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $tags = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $tags, $expire);
        return $tags;
    }

    public function add()
    {
        $query = 'INSERT INTO `tags`(`tag`,`url`) VALUES (:tag, :url)';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':tag' => $this->tag, ':url' => $this->url]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return $dbh->lastInsertId();

    }

    public function removed()
    {
        $query = "DELETE FROM `tags` WHERE `id`= :id LIMIT 1";
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return (bool)$res->rowCount();
    }

    public function getTag()
    {
        $query = 'SELECT * FROM `tags` WHERE `tag`=:tag OR `id` = :id';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':tag' => $this->tag, ':id' => $this->id]);
        $tag = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tag;
    }

}