<?php


class UsersadmModel
{
    use ResponseTrait;
    use errTrait;
    public $text;
    public $id;
    public $column;

    public function all()
    {
        $query = 'SELECT * FROM `users`';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $users = $res->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function update()
    {
        $user = new UserModel();
        $user = $user->getUserByLogin($login = null, $this->id);
        if (empty($user)) {
            $this->getResponse(['success' => false, 'err' =>
                'Такой пользователь не существует, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
        }
        $query = 'UPDATE `users` SET `' . $this->column . '`=:text WHERE `id` = :id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id, ':text' => $this->text]);
        return (bool)$res->rowCount();
    }

    public function removed()
    {
        $query = 'DELETE FROM `users` WHERE `id`=:id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        return (bool)$res->rowCount();
    }

}