<?php


class CategoriesadmModel
{
    const CACHE_KEY = 'categories-site';
    public $id;
    public $title;
    public $description;
    public $url;
    public $enabled;
    public $column;
    public $text;
    public $start;
    public $limit;
    public $page;

    public function all()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY.'-'.$this->page;
        $cachedCategories = Cache::get($cacheKey);
        if ($cachedCategories) {
            return $cachedCategories;
        }
        $query = 'SELECT * FROM `categories`  ORDER BY `id` DESC LIMIT '.$this->start.', '.$this->limit.'';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $categories = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $categories, $expire);
        return $categories;
    }

    public function add()
    {
        $query = 'INSERT INTO `categories`(`name`, `description`, `url`, `enabled`) VALUES ( :title, :description, :url, :enabled)';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':title' => $this->title, ':description' => $this->description, ':url' => $this->url, ':enabled' => $this->enabled]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return $dbh->lastInsertId();
    }

    public function update()
    {
        $query = 'UPDATE `categories` SET `' . $this->column . '`=:text WHERE `id` = :id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id, ':text' => $this->text]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return (bool)$res->rowCount();
    }

    public function removed()
    {
        $query = "DELETE FROM `categories` WHERE `id`= :id LIMIT 1";
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return (bool)$res->rowCount();
    }

    public function getCategory()
    {
        $query = 'SELECT * FROM `categories` WHERE `id`=:id';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        $link = $res->fetchAll(PDO::FETCH_ASSOC);
        return $link;
    }


}