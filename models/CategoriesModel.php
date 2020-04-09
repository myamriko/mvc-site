<?php


class CategoriesModel
{
    const CECHE_KEY = 'categories-site';

    public function all()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CECHE_KEY;
        $cachedCategories = Cache::get($cacheKey);
        if ($cachedCategories) {
            return $cachedCategories;
        }
        $query = 'SELECT * FROM `categories`';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $categories = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $categories, $expire);
        return $categories;
    }
}