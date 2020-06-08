<?php


class PageadmModel
{
    const CACHE_KEY = 'page-limit';

    public $text;
    public $column;
    public $cacheName;

    public function pageLimit()
    {
        $dbh = DB::getInstance();
        $query = 'SELECT * FROM `page_limit`';
        $res = $dbh->query($query);
        $res = $res->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function update()
    {
        $column = $this->column;
        if ($column) {
            $query = 'UPDATE `page_limit` SET `' . $column . '`=:text WHERE `id` = 1 LIMIT 1';
            $dbh = DB::getInstance();
            $res = $dbh->prepare($query);
            $res->execute([':text' => $this->text]);
            Cache::forget($this->cacheName);
            return (bool)$res->rowCount();
        }
        $this->getResponse(['success' => false, 'err' => 'Не указан столбец BD']);
    }

}