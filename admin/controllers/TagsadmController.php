<?php

use \interfaces\ControllerInterface as Controller;

class TagsadmController implements Controller
{
    use ResponseTrait;
    use ExtraTrait;

    const TABLE_NAME = 'tags';
    const PAGE_NAME = 'tags-adm/index';
    const  CACHE_DATA = '../public/storage/cache_data/';

    public function index()
    {
        global $smarty;
        $pageName = self::PAGE_NAME; //для пагинации
        $pageLimit = new PageadmModel();//лимит на страние
        $tagLimit=$pageLimit->pageLimit();
        $tagsLimit = $tagLimit['pageLimitTagPanel'];// колво ссылок на странице
        $tableName = self::TABLE_NAME;
        $data = $this->pagination($pageName, $tagsLimit, $tableName);

        $tags = new TagsadmModel();
        $tags->page = $data['page'];
        $tags->start = $tagsLimit * ($data['page'] - 1);//LIMIT start
        $tags->limit = $tagsLimit;//LIMIT finish
        $tag = $tags->all();
        $hint = $this->hint($tag, 'tag');
        $smarty->assign('hint', $hint);
        $smarty->assign('tags', $tag);
        $smarty->assign('tagsLimit', $tagsLimit);
        $smarty->assign('pagination', $data['pagination']);//пагинация
        $smarty->display('admin/tags.tpl');
    }

    public function add()
    {
        if (!empty($_POST['tag'])) {
            $tag = filter_var(trim($_POST['tag']), FILTER_SANITIZE_STRING);
            $tag = mb_strtolower($tag);// все в нижнем регистре
            $tags = new TagsadmModel();
            $tags->tag = $tag;
            $tagExist = $tags->getTag();
            if ($tagExist) {
                $this->getResponse(['success' => false, 'err' => ' Тег "' . $tag . '" уже существует.']);
            }
            if (strlen($tag) < 5) {
                $this->getResponse(['success' => false, 'err' => ' Тег не может быть короче 3х символов.']);
            }
            $urls = new Translite();
            $url = $urls->cyrillic($tag);
            $tags->url = $url;
            $tags->tag = $tag;
            $tagsAdd = $tags->add();
            $this->getResponse(['success' => $tagsAdd, 'err' => 'Не удалось внести изменения в БД', 'url' => $url]);

        }
        $this->getResponse(['success' => false, 'err' => 'Пустой POST запрос']);
    }

    public function removed()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $tags = new TagsadmModel();
            $tags->id = $id;
            $tagExist = $tags->getTag();
            if (!$tagExist) {
                $this->getResponse(['success' => false, 'err' => 'Такой тег не существует, 
                пожалуйста очистьте кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
            }
            $removedTags = $tags->removed();
            $this->getResponse(['success' => $removedTags, 'err' => 'Не удалось удалить тег, пожалуйста очистьте кеш, пожалуйста обновите 
            страничку и повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта.']);
        }

        $this->getResponse(['success' => false, 'err' => 'Пустой POST запрос']);
    }
}