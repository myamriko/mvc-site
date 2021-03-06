<?php


class CommentsModel
{
    const CACHE_NAME = 'widget-last_Comments';

    public function commentsCount($articleID)
    {
        $query = "SELECT COUNT(*) FROM `comments` WHERE `article_id` = " . $articleID;
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $count = $res->fetch();
        return $count;
    }

    public function commentsRead($articleID, $parentID)
    {
        $query = "SELECT * FROM `comments` WHERE `article_id` = " . $articleID . " && `parent_id` = " . $parentID . " ORDER BY `id` DESC ";
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $comments = $res->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function send($userName, $userId, $text, $article_id_comment, $parentId, $getArticle)
    {
        $query = "INSERT INTO `comments` (`username`, `user_id`, `mess`, `article_id`, `parent_id`) VALUES (:username, :user_id, :mess, :article_id, :parent_id)";
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':username' => $userName, ':user_id' => $userId, ':mess' => $text, ':article_id' => $article_id_comment, ':parent_id' => $parentId]);
        Cache::forget(self::CACHE_NAME.'-'.$getArticle);//очистить кеш
        return $dbh->lastInsertId();
    }

    public function remove($id, $getArticle)
    {
        $query = 'DELETE FROM `comments` WHERE `id`=:id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $id]);
        Cache::forget(self::CACHE_NAME.'-'.$getArticle);//очистить кеш
        return (bool)$res->rowCount();
    }

    public function edit($id, $text, $getArticle)
    {

        $query = 'UPDATE `comments` SET `mess`= :text WHERE `id` = :id';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $id, 'text' => $text]);
        Cache::forget(self::CACHE_NAME.'-'.$getArticle);//очистить кеш
        return (bool)$res->rowCount();

    }

    public function getCommentById($id)
    {
        $query = "SELECT * FROM `comments` WHERE `id` = " . $id;
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $comment = $res->fetch();
        return $comment;
    }

    public function getCommentByParentId($id)
    {
        $query = "SELECT * FROM `comments` WHERE `parent_id` = " . $id;
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $comment = $res->fetch();
        return (bool)$comment;
    }

}