<?php


class UsersadmModel
{
    const CECHE_KEY = 'users-panel';
    public $text;
    public $id;
    public $column;

    public function all()
    {
        $siteData = InfoModel::info();
        $expire = $siteData['cechetime'];
        $cacheKey = self::CECHE_KEY;
        $cachedUsers = Cache::get($cacheKey);
        if ($cachedUsers) {
            return $cachedUsers;
        }
        $query = 'SELECT * FROM `users`';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $users = $res->fetchAll(PDO::FETCH_ASSOC);
        Cache::set($cacheKey, $users, $expire);
        return $users;
    }

    public function update()
    {
        $query = 'UPDATE `users` SET `' . $this->column . '`=:text WHERE `id` = :id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id, ':text' => $this->text]);
        Cache::forget(self::CECHE_KEY);//очистить кеш
        return (bool)$res->rowCount();
    }

    public function removed()
    {
        $query = 'DELETE FROM `users` WHERE `id`=:id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        Cache::forget(self::CECHE_KEY);//очистить кеш
        return (bool)$res->rowCount();
    }

}