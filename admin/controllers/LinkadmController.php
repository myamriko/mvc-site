<?php

use \interfaces\ControllerInterface as Controller;

class LinkadmController implements Controller
{
    use ResponseTrait;
    use errTrait;
    use ExtraTrait;


    /**
     * @throws SmartyException
     * * страница ссылки меню модель MenuModel переход на ссылки менб со списка меню
     */
    public function index()
    {
        global $smarty;
        global $param;
        if (!empty($param[0])) {
            $menuEdit = new MenuModel();
            $menuName = trim(strip_tags($param[0]));
            $menuEdit->menuName = $menuName;
            $menuEdits = $menuEdit->link();
            $hint = $this->hint($menuEdits,'title');
            $smarty->assign('hint', $hint);
           // $smarty->assign('param', $param[0]);
            $smarty->assign('menuEdits', $menuEdits);
            $smarty->display('admin/menu-link.tpl');

            return;
        }
        $empty = '<span class="blockquote">Получен пустой параметр</span>';
        $smarty->assign('empty', $empty);
        $smarty->display('admin/menu-link.tpl');
    }

    public function add()
    {

        if (!empty($_POST['menu_name']) && $_POST['title'] && $_POST['description'] && $_POST['url'] && $_POST['enabled']) {
            $menu_name = filter_var(trim($_POST['menu_name']), FILTER_SANITIZE_STRING);
            $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
            $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
            $urlPost = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
            $enabled = filter_var(trim($_POST['enabled']), FILTER_SANITIZE_STRING);
            $url = new Translite();
            $url = $url->cyrillic($urlPost);
            $err = $this->getErrMenu($menu_name, $title, $description, $url);
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
            $linkAdd = new LinkadmModel();
            $linkAdd->menu_name = $menu_name;
            $linkAdd->title = $title;
            $linkAdd->description = $description;
            $linkAdd->url = $url;
            $linkAdd->enabled = $enabled;
            $linkAdd = $linkAdd->add();
            $this->getResponse(['success' => $linkAdd, 'err' => 'Не удалось внести новую ссылку в БД.', 'url' => $url]);//если success false значить err, иначе из Linkadmmodel add передаем добавленный id

        }
        $this->getResponse(['success' => false, 'err' => 'Пустой пост запрос']);
    }

    public function update()
    {
        if (!empty($_POST['id']) && !empty($_POST['text'])) {
            $arrId = explode('-', $_POST['id']);
            $column = array_shift($arrId);
            $id = array_shift($arrId);
            $link = new LinkadmModel();
            $link->id = $id;
            $linkExist = $link->getLink();
            if (!$linkExist) {
                $this->getResponse(['success' => false, 'err' => 'Такая ссылка не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
            }
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            $url=$this->getErrUpdate($column,$text);
            $link->menu_name=$linkExist[0]['menu_name'];
            $link->column = $column;
            $link->text = $text;
            $linkUpdate = $link->update();
            $this->getResponse(['success' => $linkUpdate, 'err' => 'Изменения не были внесены.', 'url' => $url]);
        }
        $this->getResponse(['success' => false, 'err' => 'Изменения не были внесены.']);
    }

    public function removed()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $linkExist = new LinkadmModel();
            $linkExist->id = $id;
            $linkExist = $linkExist->getLink();
            switch (true) {
                case !$linkExist:
                    $this->getResponse(['success' => false, 'err' => 'Такое меню не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
                    break;
                case $linkExist[0]['enabled'] === 'ON':
                    $this->getResponse(['success' => false, 'err' => 'Не возможно удалить меню "' . $linkExist[0]['title'] . '", 
                перед удалением его необходимо отключить']);
                    break;
            }
            $removedLink = new LinkadmModel();
            $removedLink->id = $id;
            $removedLink->menu_name = $linkExist[0]['menu_name'];
            $removedLink = $removedLink->removed();
            $this->getResponse(['success' => $removedLink, 'err' => 'Не удалось удалить меню, пожалуйста очистьте кеш, обновите 
            страничку и повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой пост запрос, пожалуйста очистьте кеш, обновите страничку и повторите 
        попытку, если ошибка не исчезнет обратитесь к администратору сайта']);

    }


}