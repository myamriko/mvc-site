<?php


class MenuModel
{
    const CACHE_KEY = 'menu-site';
    public $menuName;

    /**
     * @return array|null
     * извлекает ссылки меню на сай
     */

    public function menu()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY;
        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            return $cachedData;
        }
        $query = 'SELECT * FROM `menu-name`';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $menu = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $menu, $expire);
        return $menu;
    }

    public function link()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY.'-'.$this->menuName;
        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            return $cachedData;
        }
        $query = 'SELECT * FROM `menu` WHERE `menu_name` = :menuName  ORDER BY `id` ASC';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':menuName' => $this->menuName]);
        $menu = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $menu, $expire);
        return $menu;
    }

}