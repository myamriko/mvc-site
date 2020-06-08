<?php

use \interfaces\ControllerInterface as Controller;

class CategoriesadmController implements Controller
{
    use ResponseTrait;
    use errTrait;
    use ExtraTrait;

    const TABLE_NAME = 'categories';
    const PAGE_NAME = 'categories-adm/index';

    public function index()
    {
        global $smarty;
        $pageName = self::PAGE_NAME; //для пагинации
        $pageLimit = new PageadmModel();//лимит на страние
        $categoryLimit=$pageLimit->pageLimit();
        $categoryLimit = $categoryLimit['pageLimitCategoryPanel'];// колво ссылок на странице
        $tableName = self::TABLE_NAME;
        $data = $this->pagination($pageName, $categoryLimit, $tableName);

        $categories = new CategoriesadmModel();
        $categories->page = $data['page'];
        $categories->start = $categoryLimit * ($data['page'] - 1);//LIMIT start
        $categories->limit = $categoryLimit;//LIMIT finish
        $category = $categories->all();
        $hint = $this->hint($category, 'name');
        $smarty->assign('hint', $hint);
        $smarty->assign('categories', $category);
        $smarty->assign('categoryLimit', $categoryLimit);
        $smarty->assign('pagination', $data['pagination']);//пагинация
        $smarty->display('admin/categories.tpl');
    }

    public function add()
    {
        if (!empty($_POST['title'] && $_POST['description'] && $_POST['url'] && $_POST['enabled'])) {
            $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
            $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
            $urlPost = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
            $enabled = filter_var(trim($_POST['enabled']), FILTER_SANITIZE_STRING);
            $url = new Translite();
            $url = $url->cyrillic($urlPost);
            $err = $this->getErrMenu($menu_name = null, $title, $description, $url);
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
            $categoryAdd = new CategoriesadmModel();
            $categoryAdd->title = $title;
            $categoryAdd->description = $description;
            $categoryAdd->url = $url;
            $categoryAdd->enabled = $enabled;
            $categoryAdd = $categoryAdd->add();
            $this->getResponse(['success' => $categoryAdd, 'err' => 'Не удалось внести новую категорию в БД.', 'url' => $url]);//если success false значить err, иначе через $categoryAdd получаем добавленный id
        }
        $this->getResponse(['success' => false, 'err' => 'Пустой ПОСТ запрос']);
    }

    public function update()
    {
        if (!empty($_POST['id']) && !empty($_POST['text'])) {
            $arrId = explode('-', $_POST['id']);
            $column = array_shift($arrId);
            $id = array_shift($arrId);
            $categoryExist = new CategoriesadmModel();
            $categoryExist->id = $id;
            $categoryExist = $categoryExist->getCategory();
            if (!$categoryExist) {
                $this->getResponse(['success' => false, 'err' => 'Такой категория не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
            }
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            $url = $this->getErrUpdate($column, $text);
            $categoryUpdate = new CategoriesadmModel();
            $categoryUpdate->id = $id;
            $categoryUpdate->column = $column;
            $categoryUpdate->text = $text;
            $categoryUpdate = $categoryUpdate->update();
            $this->getResponse(['success' => $categoryUpdate, 'err' => 'Изменения не были внесены.', 'url' => $url]);
        }
        $this->getResponse(['success' => false, 'err' => 'Изменения не были внесены.']);
    }

    public function removed()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $categoryExist = new CategoriesadmModel();
            $categoryExist->id = $id;
            $categoryExist = $categoryExist->getCategory();
            switch (true) {
                case !$categoryExist:
                    $this->getResponse(['success' => false, 'err' => 'Такая категория не существует, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
                    break;
                case $categoryExist[0]['enabled'] === 'ON':
                    $this->getResponse(['success' => false, 'err' => 'Не возможно удалить категорию "' . $categoryExist[0]['name'] . '", 
                перед удалением ее необходимо отключить']);
                    break;
            }
            $categoryRemoved = new CategoriesadmModel();
            $categoryRemoved->id = $id;
            $categoryRemoved = $categoryRemoved->removed();
            $this->getResponse(['success' => $categoryRemoved, 'err' => 'Не удалось удалить категорию, пожалуйста очистьте кеш, обновите 
            страничку и повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта.']);
        }
    }
}