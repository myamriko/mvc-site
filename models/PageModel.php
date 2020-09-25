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

    public function allArticleBlog($category)
    {
        $dbh = DB::getInstance();
        $res = $dbh->query("SELECT * FROM `$this->tableName` WHERE `category`= '$category'  && `published`= 'ON'");
        $count = $res->rowCount();
        !$count ? $count = 1 : $count = $count;
        return $count;
    }

    public function allArticleTeg($tag)
    {
        $tag = '%' . $tag . '%';
        $dbh = DB::getInstance();
        $query = "SELECT * FROM `$this->tableName` WHERE `tags` LIKE '$tag'  && `published`= 'ON'";
        $res = $dbh->query($query);
        $count = $res->rowCount();
        !$count ? $count = 1 : $count = $count;
        return $count;
    }
}
