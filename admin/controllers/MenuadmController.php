<?php

use \interfaces\ControllerInterface as Controller;

class MenuadmController implements Controller
{
    use ResponseTrait;
    use errTrait;

    public function index()
    {
        global $smarty;
        $menuName = new MenuadmModel();
        $menuNames = $menuName->menu();
        $smarty->assign('menuNames', $menuNames);
        $smarty->display('admin/menu.tpl');
    }

    public function add()
    {
        if (!empty($_POST['menu_name']) && $_POST['title'] && $_POST['description'] && $_POST['enabled']) {
            $menu_name = filter_var(trim($_POST['menu_name']), FILTER_SANITIZE_STRING);
            $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
            $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
            $enabled = filter_var(trim($_POST['enabled']), FILTER_SANITIZE_STRING);
            $err = $this->getErrMenu($menu_name, $title, $description);
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
            $menuAdd = new MenuadmModel();
            $menuAdd->menu_name = $menu_name;
            $menuAdd->title = $title;
            $menuAdd->description = $description;
            $menuAdd->enabled = $enabled;
            $menuAdd = $menuAdd->add();
            $this->getResponse(['success' => $menuAdd, 'err' => 'Не удалось внести новое меню в БД.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пустой пост запрос']);
    }

    public function update()
    {
        // $this->getResponse(['success' => false, 'err' => $_POST['text']]);
        if (!empty($_POST['id']) && !empty($_POST['text'])) {
            $arrId = explode('-', $_POST['id']);
            $column = array_shift($arrId);
            $id = array_shift($arrId);
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            switch (true) {
                case $column === 'title':
                    $err = $this->getErrMenu($menu_name = null, $text, $description = null, $url = null);
                    if ($err) {
                        $this->getResponse(['success' => false, 'err' => $err]);
                    }
                    break;
                case $column === 'description':
                    $err = $this->getErrMenu($menu_name = null, $title = null, $text, $url = null);
                    if ($err) {
                        $this->getResponse(['success' => false, 'err' => $err]);
                    }
                    break;
            }
            $menuExist = new MenuadmModel();
            $menuExist->id = $id;
            $menuExist = $menuExist->getMenu();
            if (!$menuExist) {
                $this->getResponse(['success' => false, 'err' => 'Такое меню не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошебка не исчезнет обратитесь к администратору сайта']);
            }
            $menuUpdate = new MenuadmModel();
            $menuUpdate->id = $id;
            $menuUpdate->column = $column;
            $menuUpdate->text = $text;
            $menuUpdate = $menuUpdate->update();
            $this->getResponse(['success' => $menuUpdate, 'err' => 'Изменения не были внесены.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Изменения не были внесены.']);
    }

    public function removed()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $menuExist = new MenuadmModel();//проверим наличие меню и его отображение ВКЛ/ВЫКЛ
            $menuExist->id = $id;
            $menuExist = $menuExist->getMenu();
            switch (true) {
                case !$menuExist:
                    $this->getResponse(['success' => false, 'err' => 'Такое меню не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошебка не исчезнет обратитесь к администратору сайта']);
                    break;
                case $menuExist[0]['enabled'] === 'ON':
                    $this->getResponse(['success' => false, 'err' => 'Не возможно удалить меню "' . $menuExist[0]['title'] . '", 
                перед удалением его необходимо отключить']);
                    break;
            }
            $menuName = $menuExist[0]['menu_name'];
            $linkExit = new MenuModel();
            $linkExit->menuName = $menuName;
            $linkExit = $linkExit->menu();// проверим есть ли ссылки в меню
            if ($linkExit) {
                $removedLinks = new LinkadmModel();//удалим ссылки меню
                $removedLinks = $removedLinks->removedAllLink($menuName);
                if (!$removedLinks) {
                    $this->getResponse(['success' => $removedLinks, 'err' => 'Не удалось удалить ссылку меню, пожалуйста очистьте кеш,
                 пожалуйста обновите страничку и повторите попытку, если ошебка не исчезнет обратитесь к администратору сайта.']);
                }
            }
            $removedMenu = new MenuadmModel();
            $removedMenu->id = $id;
            $removedMenu = $removedMenu->removed();
            $this->getResponse(['success' => $removedMenu, 'err' => 'Не удалось удалить меню, пожалуйста очистьте кеш, пожалуйста обновите 
            страничку и повторите попытку, если ошебка не исчезнет обратитесь к администратору сайта.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой пост запрос, пожалуйста очистьте кеш, обновите страничку и повторите 
        попытку, если ошебка не исчезнет обратитесь к администратору сайта']);
    }
}