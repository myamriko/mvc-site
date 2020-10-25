<?php


class SearchModel
{

    const CACHE_KEY = 'search';

    public function search($text)
    {
        if (empty($text)){ // если пустой запрос
            return [];
        }

        $key = self::CACHE_KEY.'-'.$text;//ключ имя в кеше
        $cache_search = Cache::get($key);// получим данные из кеша
        if ($cache_search){
            return [
                'cache'=>'true',// это что бы видеть в консоле из кеша анные или нет
                'data'=>$cache_search
            ];
        }
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $text='%'.$text.'%'; //переменную получаем из searchController/make
        $query = "SELECT * FROM `articles` WHERE  `title` LIKE ? LIMIT 15";
        $dbh=DB::getInstance();
        $res=$dbh->prepare($query);
        $res->execute([$text]);
        $search=$res->fetchAll(PDO::FETCH_ASSOC);
        if (empty($search)){
            return [
                'cache'=>'false',// это что бы видеть в консоле из кеша анные или нет
                'data'=>$search
            ];
        }
        Cache::set($key,$search,$expire);//записываем данные в кеш
        return [
            'cache'=>'false',// это что бы видеть в консоле из кеша анные или нет
            'data'=>$search
        ];

    }

}