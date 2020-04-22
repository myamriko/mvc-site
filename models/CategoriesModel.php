<?php


class CategoriesModel
{
    const CACHE_KEY = 'categories-site';

    public function all()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY;
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