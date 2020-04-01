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
            $this->getResponse(['success' => $users, 'err' => 'Вы не внесли изменения при редактировании.', 'name_pic' => $name_pic, 'name_pic_old' => $userData[$column]]);
        }

        if (!empty($text = $_POST['text'])) {
            $users = new UsersadmModel();
            $users->text = filter_var(trim($text), FILTER_SANITIZE_STRING);
            $users->id = $id;
            $users->column = $column;
            $users = $users->update();
            $this->getResponse(['success' => $users, 'err' => 'Вы не внесли изменения при редактировании.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Вы не внесли изменения при редактировании.', 'name_pic_old' => $userData[$column]]);
    }

    public function removed()
    {
        $id = $_POST['id'];
        if (!empty($id)) {
            $checkUser = new UserModel();
            $checkUser = $checkUser->getUserByLogin($login = null, $id);
            if (!$checkUser) {
                $this->getResponse(['success' => false, 'err' => 'Такой пользователь не существует, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
            }
            $removedUser = new UsersadmModel();
            $removedUser->id = $id;
            $removedUser = $removedUser->removed();
            $this->getResponse(['success' => $removedUser, 'err' => 'Пользователь не был удален из БД.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос на удаление']);
    }
}