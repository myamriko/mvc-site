<?php


class TagsModel
{
    const CACHE_KEY = 'tags-site';

    public function all()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CACHE_KEY;
        $cachedTags = Cache::get($cacheKey);
        if ($cachedTags) {
            return $cachedTags;
        }
        $query = 'SELECT * FROM `tags`';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $tags = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $tags, $expire);
        return $tags;
    }

}