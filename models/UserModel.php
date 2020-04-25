<?php


class UserModel
{

    public $login;
    public $pass;
    public $userName;
    public $mail;


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
        $user=$this->getUserByLogin($login);
        $pass =  md5($this->pass.$user['salt']);
        if ($pass == $user['pass']){
            Session::set('user', $user);
            return true;
        }
        return false;
    }

    public function getUserByLogin($login=null, $id=null)
    {
        $dbh = DB::getInstance();
        $query = 'SELECT * FROM `users` WHERE `login` = :login OR `id` = :id';
        $res = $dbh->prepare($query);
        $res->execute([':login' => $login, ':id'=>$id]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

}