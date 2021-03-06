<?php


class InfoadmModel

{
    use ResponseTrait;
    public $column;
    public $text;
    public $cacheName;
    const CACHE_KEY = 'info-site';

    public function update()
    {
        $column = $this->column;
        if ($column) {
            $query = 'UPDATE `info-site` SET `' . $column . '`=:text WHERE `id` = 1 LIMIT 1';
            $dbh = DB::getInstance();
            $res = $dbh->prepare($query);
            $res->execute([':text' => $this->text]);
            Cache::forget(self::CACHE_KEY);
            Cache::forget($this->cacheName);
            return (bool)$res->rowCount();//если будет гнать поставить true
        }
        $this->getResponse(['success' => false, 'err' => 'Не указан столбец BD']);
    }

}