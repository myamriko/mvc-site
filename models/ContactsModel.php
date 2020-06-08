<?php


class ContactsModel
{
    public function addErr($err, $message)
    {
        $query = 'INSERT INTO `mail-err`(`err`, `message`) VALUES (:err, :message)';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $err = $res->execute([':err' => $err, ':message' => $message]);
        return (bool)$err;
    }

    public function allErr()
    {
        $query = 'SELECT * FROM  `mail-err`';
        $dbh= DB::getInstance();
        $res= $dbh->query($query);
        $res=$res->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}