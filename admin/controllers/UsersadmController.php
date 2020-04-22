<?php

use interfaces\ControllerInterface as Controller;

class UsersadmController implements Controller
{
    use errTrait;
    use ResponseTrait;
    use UploadTrait;
    use ExtraTrait;

    const TABLE_NAME = 'users';
    const PAGE_NAME = 'users-adm/index';

    public function index()
    {
        global $smarty;
        $pageName = self::PAGE_NAME; //для пагинации
        $siteData = InfoModel::info();//info сайта
        $userLimit = $siteData['pageLimitUserPanel'];// колво статей на странице
        $tableName = self::TABLE_NAME;
        $data = $this->pagination($pageName, $userLimit, $tableName);

        $user = new UsersadmModel();
        $user->page = $data['page'];
        $user->start = $userLimit * ($data['page'] - 1);//LIMIT start
        $user->limit = $userLimit;//LIMIT finish
        $users = $user->all();
        $hint = $this->hint($users, 'username');
        $tagSearch = $this->hint($users, 'login');
        $smarty->assign('tagSearch', $tagSearch);
        $smarty->assign('hint', $hint);
        $smarty->assign('users', $users);
        $smarty->assign('userLimit', $userLimit);
        $smarty->assign('pagination', $data['pagination']);//пагинация
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
            $err = $this->getErrImg();
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err, 'name_pic_old' => $userData[$column]]);
            }
            $name_pic = $this->uploadPic($uploads_dir);//трейт загрузки
            if (file_exists($oldIcoDir) && $oldIcoDir !== $uploads_dir . '/' . 'anonimus.png') {
                unlink($oldIcoDir);//удаляем старый фаил
            };
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
                    $err = $this->getErrUser($login = null, $pass = null, $rePass = null, $text, $mail = null);
                    if ($err) {
                        $this->getResponse(['success' => false, 'err' => $err]);
                    }
                    break;
                case $column === 'email':
                    $err = $this->getErrUser($login = null, $pass = null, $rePass = null, $userName = null, $text);
                    if ($err) {
                        $this->getResponse(['success' => false, 'err' => $err]);
                    }
                    break;
                case $column === 'login':
                    $err = $this->getErrUser($text, $pass = null, $rePass = null, $userName = null, $mail = null);
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
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
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
            if (!$removedUser) {
                $this->getResponse(['success' => $removedUser, 'err' => 'Пользователь не был удален из БД, пожалуйста очистьте 
            кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
            }

            $uploads_dir = '../public/pic/avatar'; //дериктория куда сохраняем
            $avatar = $uploads_dir . '/' . $checkUser['avatar'];
            if (file_exists($avatar) && $avatar !== $uploads_dir . '/' . 'anonimus.png') {
                unlink($avatar);//удаляем старый фаил
            };
            $this->getResponse(['success' => $removedUser]);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос на удаление, пожалуйста очистьте кеш, 
        обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
    }
}