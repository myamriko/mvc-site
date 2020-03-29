<?php


class UsersController
{
    use ResponseTrait;
    use errTrait;

    /**
     *
     */
    public function registr()
    {

        if (!empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['repass']) && !empty($_POST['name']) && !empty($_POST['mail'])) {
            $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
            $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
            $rePass = filter_var(trim($_POST['repass']), FILTER_SANITIZE_STRING);
            $userName = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
            $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
            $err = $this->getErrUser($login, $pass, $rePass, $userName, $mail);//проверка на ошибки
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
            $user = new UserModel();//регистрация
            $user->login = $login;//передаем переменные
            $user->pass = $pass;
            $user->userName = $userName;
            $user->mail = $mail;
            $resReg = $user->registrUser();//регестрируем
            $this->getResponse(['success' => $resReg, 'err' => ' Не удалось зарегистрировать пользователя.']);

        }
        $this->getResponse(['success' => false, 'err' => 'Все поля обязательны для заполнения!']);

    }


    public function login()
    {
        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
            $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
            $err = $this->getErrUser($login, $pass);
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
            $user = new UserModel();
            $user->login = $login;
            $user->pass = $pass;
            $resLogin = $user->loginUser();
            $this->getResponse(['success' => $resLogin, 'err' => ' Имя пользователя или пароль указаны не верно.']);
        }
        $this->getResponse(['success' => false, 'err' => ' Поля лоин и пароль обязательны для заполнения!']);
    }

    public function logout()
    {
        Session::flash();
        header('Location: /main');
    }

}