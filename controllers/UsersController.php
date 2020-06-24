<?php


class UsersController
{
    use ResponseTrait;
    use errTrait;
    use ExtraTrait;

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
            $Return = $this->captcha();//ExtraTrait
            if ($Return->success != true || $Return->score < 0.5){
                $this->getResponse(['success' => false, 'err' => ' Гугл вирішив, що Ви робот!']);
            }
            $user = new UserModel();//регистрация
            $userExist = $user->getUserByLogin($login);
            if ($userExist) {
                $this->getResponse(['success' => false, 'err' => ' Користувач з логіном "' . $login . '" існує.']);
            }
            $user->login = $login;//передаем переменные
            $user->pass = $pass;
            $user->userName = $userName;
            $user->mail = $mail;
            $resReg = $user->registrUser();//регестрируем
            $this->getResponse(['success' => $resReg, 'err' => ' Не вдалося зареєструвати користувача.']);

        }
        $this->getResponse(['success' => false, 'err' => 'Всі поля обов\'язкові для заповнення!']);

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
            $Return = $this->captcha();//ExtraTrait
            if ($Return->success != true || $Return->score < 0.5){
                $this->getResponse(['success' => false, 'err' => ' Гугл вирішив, що Ви робот!']);
            }
            $user = new UserModel();
            $user->login = $login;
            $user->pass = $pass;
            $userExist = $user->getUserByLogin($login);
            if (!$userExist){
                    $this->getResponse(['success' => false, 'err' => ' Користувача з логіном "' . $login . '" не існує. Зареєструйтесь.']);
            }
            $resLogin = $user->loginUser();
            $this->getResponse(['success' => $resLogin, 'err' => ' Ім\'я користувача або пароль вказано невірно.']);
        }
        $this->getResponse(['success' => false, 'err' => ' Поля лоін і пароль є обов\'язковими для заповнення!']);
    }

    public function logout()
    {
        Session::flash();
        header('Location: /');
    }

}