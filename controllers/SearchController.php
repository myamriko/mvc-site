<?php

use \interfaces\ControllerInterface as Controller;

class SearchController implements Controller

{
    use ResponseTrait;
    use ViewsTrait;

    /**
     * @throws SmartyException
     * Страница поиска главная
     */
    public function index()
    {
        global $smarty;
        global $controller;

        if (!empty($_GET['searchMain'])){
            $searchMain = filter_var(trim($_GET['searchMain']), FILTER_SANITIZE_STRING);
            $searchText = filter_var(trim($_GET['searchText']), FILTER_SANITIZE_STRING);

            $Alert = '<div id="searchAlert" role="alert">
                            <p>На жаль по вашому запиту нічого не знайдено. Спробуйте змінити критерії пошуку.</p>
                        </div>';

            switch (true) {
                case $_GET['searchMain'] != '' && strlen($searchMain) < 3;
                    $searchAlert = $Alert;
                    break;

                case $_GET['searchMain'] === '';
                    $searchAlert = $Alert;
                    break;
            }

            if ($searchMain){
                $search = new SearchModel();
                $search = $search->search($searchMain, 0, $searchText);// откл лимит 15 строк в поиске
                if (!$search["data"]){
                    $searchAlert = $Alert;
                }
            }
        }

        $lastArticles = WidgetModel::lastArticle();
        $this->menuPrincipal();
        $this->menuCategory();
        $nogoogl = '<meta name="robots" content="noindex">';//не индексировать
        $description = 'Сторінка пошуку по сайту';
        $categoryPage = 'Пошук по сайту';
        $tagsModel = new TagsModel();
        $tagsAll = $tagsModel->all();

        $smarty->assign('searchAlert', $searchAlert);
        $smarty->assign('action', $controller);
        $smarty->assign('tagsAll', $tagsAll);
        $smarty->assign('nogoogl', $nogoogl);
        $smarty->assign('description', $description);
        $smarty->assign('categoryPage', $categoryPage);
        $smarty->assign('lastArticles', $lastArticles);
        $smarty->assign('article', $search["data"]);
        $smarty->display('public/search.tpl');

    }

    /**
     * Быстрый поиск в блоге
     */

    public function make()
    {
        $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
        $search = new SearchModel();
        $search = $search->search($text);
        $this->getResponse([$search]);
    }

}