<?php

class Cache
{
    use ResponseTrait;
    const  CACHE_DATA = '../public/storage/cache_data/';
    const  CACHE_TIME = 86400;

    /**
     * @param $key
     * @param null $default
     * @return |null
     */
    public static function get($key, $default = null)
    {
        $fileName = self::CACHE_DATA . $key . ".json";
        // проверим на наличие файла кеша, если нет то значение по дефолту
        if (!file_exists($fileName)) {
            return $default;
        }
        $json = file_get_contents($fileName);// считываем данные
        $data = json_decode($json, true);// декодируем json и представляем его в качестве ассоцеативного массива
        if ($data['expire'] > time()) { // если время жизни меньще текущего
            return $data['userData']; // вернем данные
        }
        // иначе чистим кеш
        self::forget($key);
        return $default;// возвращаем какието дефолтные значения

    }

    public static function set($key, $value, $expire = self::CACHE_TIME)// $expire - время жизни в секундах

    {
        $fileName = self::CACHE_DATA . $key . ".json"; // формируем путь к файлу, SELF:: доступ к константе внутри класса
        // формируем массив данных кеша
        $cacheData = [
            'userData' => $value, // пользовательские данные
            'expire' => time() + $expire // время жизни кеша
        ];
        $json = json_encode($cacheData);
        file_put_contents($fileName, $json);// $fileName - куда записываем,  $json - что записываем

    }

    public static function forget($key)
    {
        $fileName = self::CACHE_DATA . $key . ".json";
        if (!file_exists($fileName)) {
            return false;
        }
        unlink($fileName);
        return false;

    }

}