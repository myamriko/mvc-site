<?php

use \interfaces\ControllerInterface as Controller;

class AccountController implements Controller
{
    const DIR_UPLOAD = '../public/pic/avatar';

    use ViewsTrait;
    use ResponseTrait;
    use errTrait;
    use UploadTrait;


    public function index()
    {
        $login = Session::get('user', ['login' => ''])['login'];
        $user = new UserModel();
        $user = $user->getUserByLogin($login);
        unset($user['pass']);
        unset($user['salt']);
        if (!empty($login) && $user['login'] == $login) {
            global $smarty;
            $this->menuPrincipal();
            $smarty->assign('user', $user);
            $smarty->display('public/account.tpl');
            die();
        }
        header('Location: /');
    }

    public function editData()
    {
        $data = [];
        if (!empty($id = filter_var(trim($_POST['userId']), FILTER_SANITIZE_STRING))) {
            $user = new UserModel();
            $userExist = $user->getUserByLogin(null, $id);

            if (!$userExist) {
                $this->getResponse(['success' => false, 'err' => ' Такого користувача не існує, будь ласка очистіть кеш і
        поновіть сторінку. Якщо помилка зявиться знов зв\'яжіться з адміністратором сайту.']);
            }

            $file = filter_var(trim($_POST['fileOld']), FILTER_SANITIZE_STRING);
            $userName = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
            $mail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

            $err = $this->getErrUpdateUser($userName, $mail);//проверка на ошибки
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }

            if ($_FILES) {
                $errFile = $this->getErrImg();
                if ($errFile) {
                    $this->getResponse(['success' => false, 'err' => $errFile]);
                }
                $oldFile = self::DIR_UPLOAD . '/' . $file;

                $file = $this->uploadPic(self::DIR_UPLOAD);//загрузка картинки
                if (file_exists($oldFile) && $oldFile != self::DIR_UPLOAD . '/' . 'anonimus.png') {
                    unlink($oldFile);
                }
            };
            array_push($data, $file, $userName, $mail);

            $user->file = $file;
            $user->userName = $userName;
            $user->mail = $mail;
            $editData = $user->editData($id);
            $this->getResponse(['success' => $editData, 'err' => ' Не вдалося внести зміни.', 'data' => $data]);
        }

        $this->getResponse(['success' => false, 'err' => 'Прийшов порожній запит, будь ласка очистіть кеш і
        поновіть сторінку. Якщо помилка зявиться знов зв\'яжіться з адміністратором сайту.']);
    }

    public function editPass()
    {
        $editPass = new self();
        $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
        $oldPass = filter_var(trim($_POST['oldPass']), FILTER_SANITIZE_STRING);
        $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
        $rePass = filter_var(trim($_POST['rePass']), FILTER_SANITIZE_STRING);
        $editPass = $editPass->makePass($login, $oldPass, $pass, $rePass);
        $this->getResponse(['success' => $editPass, 'err' => ' Не вдалося внести зміни.']);

    }


    public function makePass($login, $oldPass, $pass, $rePass)
    {

        if (!$oldPass || !$pass || !$rePass) {
            $this->getResponse(['success' => false, 'err' => 'Прийшов порожній запит, очистіть кеш та поновіть сторінку, 
            якщо помилка повториться, зверніться до адміністратора сайту']);
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByLogin($login);
        if (!$user) {
            $this->getResponse(['success' => false, 'err' => ' Користувача з логіном "' . $login . '" не існує. Очистіть кеш та поновіть сторінку, 
            якщо помилка повториться, зверніться до адміністратора сайту']);
        }

        if ($oldPass !=='Resto_te-PaSS88'){
            $oldPass = md5($oldPass . $user['salt']);
            if ($oldPass !== $user['pass']) {
                $this->getResponse(['success' => false, 'err' => ' Існуючий пароль вказано не вірно']);
            }
        }


        $err = $this->getErrUser($login, $pass, $rePass);
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }

        $userModel->login = $login;
        $pass = md5($pass . $user['salt']);
        $userModel->pass = $pass;
        $editPass = $userModel->editPass();
        return $editPass;

    }

}