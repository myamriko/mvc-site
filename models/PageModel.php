<?php


class PageModel
{
    public $tableName;

    public function allArticle()
    {
        $dbh = DB::getInstance();
        $res = $dbh->query("SELECT * FROM `$this->tableName`");
        $count = $res->rowCount();
        !$count ? $count = 1 : $count = $count;
        return $count;
    }
}
