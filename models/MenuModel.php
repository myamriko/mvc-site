<?php


class MenuModel
{
    const CECHE_KEY = 'menu-site';
    public $menuName;

    /**
     * @return array|null
     * извлекает ссылки меню на сай
     */
    public function menu()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CECHE_KEY.'-'.$this->menuName;
        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            return $cachedData;
        }
        $query = 'SELECT * FROM `menu` WHERE `menu_name` = :menuName';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':menuName' => $this->menuName]);
        $menu = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $menu, $expire);
        return $menu;
    }

}