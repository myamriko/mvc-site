<?php


class SearchModel
{

    const CACHE_KEY = 'search';

    public function search($text, $limit=1, $searchText = null)
    {
        if (empty($text)){ // если пустой запрос
            return [];
        }
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        !$searchText ? $key = self::CACHE_KEY.'-'.$text.'-'.$limit : $key = self::CACHE_KEY.'-'.$text.'-'.$limit.'-'.$searchText;//ключ имя в кеше
        $cache_search = Cache::get($key);// получим данные из кеша
        if ($cache_search){
            return [
                'cache'=>'true',// это что бы видеть в консоле из кеша анные или нет
                'data'=>$cache_search
            ];
        }

        $text='%'.$text.'%'; //переменную получаем из searchController/make

        if($limit===1){
            $query = "SELECT * FROM `articles` WHERE  `title` LIKE ? LIMIT 15";
        }elseif ($searchText){
            $query = "SELECT * FROM `articles` WHERE CONCAT (`title`,`text` ) LIKE ? ";// поиск по двум полям
        }else{
            $query = "SELECT * FROM `articles` WHERE  `title` LIKE ?";
        }
        if($limit==='0'){
            $query = "SELECT `art`.`id`,`art`.`title`,`art`.`url`,`art`.`intro`,`cat`.`name`,`art`.`category`,`art`.`tags`,`art`.`file`,`art`.`alt`,`art`.`date`, `art`.`author`, `art`.`published`, `art`.`front` FROM `articles` AS `art` LEFT JOIN `categories` AS `cat` ON `art`.`category`=`cat`.`url` WHERE  CONCAT (`art`.`title`,`art`.`text` ) LIKE ?";
        }

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
            'cache'=>'false',// это что бы видеть в консоле из кеша данные или нет
            'data'=>$search
        ];

    }

}