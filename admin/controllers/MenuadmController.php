<?php

use \interfaces\ControllerInterface as Controller;

class MenuadmController implements Controller
{
    use ResponseTrait;
    use errTrait;
    use ExtraTrait;

    const TABLE_NAME = 'menu-name';
    const PAGE_NAME = 'menu-adm/index';

    public function index()
    {
        global $smarty;
        $pageName = self::PAGE_NAME; //для пагинации
        $pageLimit = new PageadmModel();//лимит на страние
        $menuLimit = $pageLimit->pageLimit();
        $menuLimit = $menuLimit['pageLimitMenuPanel'];// колво статей на странице
        $tableName = self::TABLE_NAME;
        $data = $this->pagination($pageName, $menuLimit, $tableName);
        $menuName = new MenuadmModel();
        $menuName->page = $data['page'];
        $menuName->start = $menuLimit * ($data['page'] - 1);//LIMIT start
        $menuName->limit = $menuLimit;//LIMIT finish
        $menuNames = $menuName->menu();
        $hint = $this->hint($menuNames, 'title');
        $smarty->assign('hint', $hint);
        $smarty->assign('menuNames', $menuNames);
        $smarty->assign('menuLimit', $menuLimit);
        $smarty->assign('pagination', $data['pagination']);//пагинация
        $smarty->display('admin/menu.tpl');
    }

    public function add()
    {
        if (!empty($_POST['menu_name']) && $_POST['title'] && $_POST['description'] && $_POST['enabled']) {
            $menu_name = filter_var(trim($_POST['menu_name']), FILTER_SANITIZE_STRING);
            $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
            $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
            $enabled = filter_var(trim($_POST['enabled']), FILTER_SANITIZE_STRING);
            $menuName = new Translite();
            $menu_name = $menuName->cyrillic($menu_name);
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
            $this->getResponse(['success' => $menuAdd, 'err' => 'Не удалось внести новое меню в БД.', 'menu_name' => $menu_name]);
        }
        $this->getResponse(['success' => false, 'err' => 'Пустой пост запрос']);
    }

    public function update()
    {
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
            $menu = new MenuadmModel();
            $menu->id = $id;
            $menuExist = $menu->getMenu();
            if (!$menuExist) {
                $this->getResponse(['success' => false, 'err' => 'Такое меню не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
            }
            $menu->column = $column;
            $menu->text = $text;
            $menuUpdate = $menu->update();
            $this->getResponse(['success' => $menuUpdate, 'err' => 'Изменения не были внесены.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Изменения не были внесены.']);
    }

    public function removed()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $menu = new MenuadmModel();//проверим наличие меню и его отображение ВКЛ/ВЫКЛ
            $menu->id = $id;
            $menuExist = $menu->getMenu();
            switch (true) {
                case !$menuExist:
                    $this->getResponse(['success' => false, 'err' => 'Такое меню не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
                    break;
                case $menuExist[0]['enabled'] === 'ON':
                    $this->getResponse(['success' => false, 'err' => 'Не возможно удалить меню "' . $menuExist[0]['title'] . '", 
                перед удалением его необходимо отключить']);
                    break;
            }
            $menuName = $menuExist[0]['menu_name'];
            $linkExist = new MenuModel();
            $linkExist->menuName = $menuName;
            $linkExist = $linkExist->link();// проверим есть ли ссылки в меню
            if ($linkExist) {
                $removedLinks = new LinkadmModel();//удалим ссылки меню
                $removedLinks = $removedLinks->removedAllLink($menuName);
                if (!$removedLinks) {
                    $this->getResponse(['success' => $removedLinks, 'err' => 'Не удалось удалить ссылку меню, пожалуйста очистьте кеш,
                обновите страничку и повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта.']);
                }
            }
            $menu->id = $id;
            $removedMenu = $menu->removed();
            $this->getResponse(['success' => $removedMenu, 'err' => 'Не удалось удалить меню, пожалуйста очистьте кеш, обновите 
            страничку и повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой пост запрос, пожалуйста очистьте кеш, обновите страничку и повторите 
        попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
    }
}