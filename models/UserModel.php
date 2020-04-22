<?php


class UserModel
{
    use ResponseTrait;
    public $login;
    public $pass;
    public $userName;
    public $mail;


    public function registrUser()
    {
        $login = $this->login;
        $userExist = $this->getUserByLogin($login);
        if ($userExist) {
            $this->getResponse(['success' => false, 'err' => ' Пользователь с логином ' . $this->login . ' существует.']);
        }
        $salt = new Salt();//класс Salt
        $salt = $salt->rnd();// случайная соль
        $pass = md5($this->pass . $salt);
        $userName = $this->userName;
        $mail = $this->mail;
        $dbh = DB::getInstance();
        $query = 'INSERT INTO users(login,pass,salt,username,email) VALUES (?,?,?,?,?) LIMIT 1';
        $res = $dbh->prepare($query);
        $res->execute([$login, $pass, $salt, $userName, $mail]);
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