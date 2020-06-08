<?php


class ContactadmModel
{
    public function report($id)
    {
        $query = 'SELECT * FROM  `mail-err` WHERE `id` = :id';
        $dbh= DB::getInstance();
        $res= $dbh->prepare($query);
        $res->execute([':id'=>$id]);
        $res=$res->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function update($id){

        $query= 'UPDATE `mail-err` SET `resend`= :resend WHERE `id` = :id';
        $dbh= DB::getInstance();
        $res= $dbh->prepare($query);
        $res->execute([':id'=>$id, ':resend'=>'YES']);
        return (bool) $res->rowCount();
    }

    public function removed($id)
    {
        $query = "DELETE FROM `mail-err` WHERE `id`= :id LIMIT 1";
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $id]);
        return (bool)$res->rowCount();
    }

}