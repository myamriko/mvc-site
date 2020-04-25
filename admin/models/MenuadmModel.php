<?php


class MenuadmModel
{
    use ResponseTrait;
    const CACHE_KEY = 'menu';
    public $id;
    public $menu_name;
    public $title;
    public $description;
    public $enabled;
    public $text;
    public $column;
    public $start;
    public $limit;
    public $page;

    public function menu()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY.'-panel'.'-'.$this->page;
        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            return $cachedData;
        }
        $query = 'SELECT * FROM `menu-name`  ORDER BY `id` DESC LIMIT '.$this->start.', '.$this->limit.'';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $menu = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $menu, $expire);
        return $menu;
    }

    public function add()
    {
        $query = 'INSERT INTO `menu-name`(`menu_name`, `title`, `description`, `enabled`) VALUES (:menu_name, :title, :description, :enabled)';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':menu_name' => $this->menu_name, ':title' => $this->title, ':description' => $this->description, ':enabled' => $this->enabled]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return $dbh->lastInsertId();
    }

    public function update()
    {
        $query = 'UPDATE `menu-name` SET `' . $this->column . '`=:text WHERE `id` = :id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id, ':text' => $this->text]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return (bool)$res->rowCount();
    }

    public function removed()
    {
        $query = "DELETE FROM `menu-name` WHERE `id`= :id LIMIT 1";
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        Cache::forget(self::CACHE_KEY);//очистить кеш
        return (bool)$res->rowCount();

    }

    public function getMenu()
    {
        $query = 'SELECT * FROM `menu-name` WHERE `id`=:id';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        $menu = $res->fetchAll(PDO::FETCH_ASSOC);
        return $menu;
    }

}