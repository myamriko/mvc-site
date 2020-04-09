<?php

use interfaces\ControllerInterface as Controller;

class UsersadmController implements Controller
{
    use errTrait;
    use ResponseTrait;
    use UploadTrait;

    public function index()
    {
        global $smarty;
        $user = new UsersadmModel();
        $users = $user->all();
        $smarty->assign('users', $users);
        $smarty->display('admin/users.tpl');
    }

    /**
     * сюди приходит id вида колонка_id в UsersadmModel разделяем на column и id
     */
    public function update()
    {
        $arrId = explode('-', $_POST['id']);
        $column = array_shift($arrId);
        $id = array_shift($arrId);
        $userData = new UserModel();
        $userData = $userData->getUserByLogin($login = null, $id);
        if (empty($userData)) {
            $this->getResponse(['success' => false, 'err' =>
                'Такой пользователь не существует, пожалуйста очистьте кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
        }

        if (!empty($_FILES)) {
            $uploads_dir = '../public/pic/avatar'; //дериктория куда сохраняем
            $oldIcoDir = $uploads_dir . '/' . $userData[$column];
            if (file_exists($oldIcoDir)) {
                unlink($oldIcoDir);//удаляем старый фаил
            };
            $name_pic=$this->uploadPic($uploads_dir);//трейт загрузки
            $users = new UsersadmModel();
            $users->text = $name_pic;
            $users->id = $id;
            $users->column = $column;
            $users = $users->update();
            $this->getResponse(['success' => $users, 'err' => 'Изменения не были внесены.', 'name_pic' => $name_pic, 'name_pic_old' => $userData[$column]]);
        }
        if (!empty($_POST['text'])) {
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            switch (true) {
                case $column === 'username':
                    $err = $this->getErrUser($login = null, $pass = null, $rePass = null, $text, $mail = null, $imgFile = null);
                    if ($err) {
                        $this->getResponse(['success' => false, 'err' => $err]);
                    }
                    break;
                case $column === 'email':
                    $err = $this->getErrUser($login = null, $pass = null, $rePass = null, $userName = null, $text, $imgFile = null);
                    if ($err) {
                        $this->getResponse(['success' => false, 'err' => $err]);
                    }
                    break;
                case $column === 'login':
                    $err = $this->getErrUser($text, $pass = null, $rePass = null, $userName = null, $mail = null, $imgFile = null);
                    if ($err) {
                        $this->getResponse(['success' => false, 'err' => $err]);
                    }
                    break;
            }
            $users = new UsersadmModel();
            $users->text = $text;
            $users->id = $id;
            $users->column = $column;
            $users = $users->update();
            $this->getResponse(['success' => $users, 'err' => 'Изменения не были внесены.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Изменения не были внесены.', 'name_pic_old' => $userData[$column]]);
    }

    public function removed()
    {
        $id = $_POST['id'];
        if (!empty($id)) {
            $checkUser = new UserModel();
            $checkUser = $checkUser->getUserByLogin($login = null, $id);
            if (!$checkUser) {
                $this->getResponse(['success' => false, 'err' => 'Такой пользователь не существует, 
                пожалуйста очистьте кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
            }
            $removedUser = new UsersadmModel();
            $removedUser->id = $id;
            $removedUser = $removedUser->removed();
            $this->getResponse(['success' => $removedUser, 'err' => 'Пользователь не был удален из БД, пожалуйста очистьте 
            кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос на удаление, пожалуйста очистьте кеш, 
        обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
    }
}