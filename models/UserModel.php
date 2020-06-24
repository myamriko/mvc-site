<?php


class UserModel
{

    public $login;
    public $pass;
    public $userName;
    public $mail;
    public $file;

    public function registrUser()
    {
        $salt = new Salt();//класс Salt
        $salt = $salt->rnd();// случайная соль
        $pass = md5($this->pass . $salt);
        $dbh = DB::getInstance();
        $query = 'INSERT INTO users(login,pass,salt,username,email) VALUES (?,?,?,?,?)';
        $res = $dbh->prepare($query);
        $res->execute([$this->login, $pass, $salt, $this->userName, $this->mail]);
        $this->loginUser();
        return (bool)$res->rowCount();
    }

    public function loginUser()
    {
        $login = $this->login;
        $user = $this->getUserByLogin($login);
        $pass = md5($this->pass . $user['salt']);
        if ($pass == $user['pass']) {
            unset($user['pass']);
            unset($user['salt']);
            Session::set('user', $user);
            return true;
        }
        return false;
    }

    public function getUserByLogin($login = null, $id = null, $email=null)
    {
        $dbh = DB::getInstance();
        $query = 'SELECT * FROM `users` WHERE `login` = :login OR `id` = :id OR `email` = :email';
        $res = $dbh->prepare($query);
        $res->execute([':login' => $login, ':id' => $id, ':email' => $email]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function editData($id)
    {
        $dbh = DB::getInstance();
        $query = 'UPDATE `users` SET `username`= :username,`email`=:email, `avatar`=:avatar WHERE `id` = :id LIMIT 1';
        $res = $dbh->prepare($query);
        $res->execute([':username' => $this->userName, ':email' => $this->mail, ':avatar' => $this->file, ':id' => $id]);
        $editData = $res->rowCount();
        return (bool)$editData;
    }

    public function editPass()
    {
        $dbh = DB::getInstance();
        $query = 'UPDATE `users` SET `pass` = :pass WHERE  `login` = :login LIMIT 1';
        $res= $dbh->prepare($query);
        $res->execute([':pass' => $this->pass, ':login' => $this->login]);
        $editPass = $res->rowCount();
        return (bool)$editPass;
    }


}