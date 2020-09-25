<?php


class CommentsModel
{

    public function commentsRead($articleID, $parentID)
    {
       $query = "SELECT * FROM `comments` WHERE `article_id` = " . $articleID." && `parent_id` = ".$parentID;
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $comments = $res->fetchAll(PDO::FETCH_ASSOC);
        return$comments;
    }

    public function commentsCount($articleID)
    {
        $query = "SELECT COUNT(*) FROM `comments` WHERE `article_id` = " . $articleID;
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $count = $res->fetch();
        return $count;
    }

}