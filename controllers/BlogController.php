<?php

use \interfaces\ControllerInterface as Controller;


class BlogController implements Controller
{

    use ViewsTrait;
    use ResponseTrait;
    use errTrait;
    use ExtraTrait;

    const TABLE_NAME = 'articles';
    const PAGE_NAME = 'blog/index';
    const PAGE_NAME_CAT = 'blog/category';
    const PAGE_NAME_TAG = 'blog/tag';


    /**
     * @param null $url
     * @throws SmartyException
     */
    public function index($url = 'blog')
    {
        global $smarty;
        $siteData = $this->menuPrincipal();
        $categories = $this->menuCategory();

        $pageName = self::PAGE_NAME; //для пагинации
        $pageLimitBlog = $siteData['pagelimit'];// колво статей на странице
        $tableName = self::TABLE_NAME;
        $data = $this->paginationBlog($pageName, $pageLimitBlog, $tableName, $url);
        $description = $categories[0]["description"];
        $categoryPage = $categories[0]["name"];
        $tagsModel = new TagsModel();
        $tagsAll = $tagsModel->all();
        $articlesModel = new ArticlesModel();
        $articlesModel->page = $data['page'];
        $articlesModel->start = $pageLimitBlog * ($data['page'] - 1);//LIMIT start
        $articlesModel->limit = $pageLimitBlog;//LIMIT finish
        $articlesAll = $articlesModel->category($url);
        $smarty->assign('url', $url);
        $smarty->assign('description', $description);
        $smarty->assign('tagsAll', $tagsAll);
        $smarty->assign('articlesAll', $articlesAll);
        $smarty->assign('categoryPage', $categoryPage);
        $smarty->assign('pagination', $data['pagination']);//пагинация
        $smarty->display('public/blog.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function category()
    {
        global $smarty;
        global $param;
        global $action;
        $url = trim(filter_var($param[0], FILTER_SANITIZE_STRING));
        $siteData = $this->menuPrincipal();
        $pageName = self::PAGE_NAME_CAT . '/' . $url; //для пагинации
        $pageLimitBlog = $siteData['pagelimit'];// колво статей на странице
        $tableName = self::TABLE_NAME;
        $data = $this->paginationBlog($pageName, $pageLimitBlog, $tableName, $url);
        $categories = $this->menuCategory();
        foreach ($categories as $category) {
            if ($category['url'] == $url) {
                $categoryPage = $category["name"];
                $description = $category["description"];
            }
        }
        $tagsModel = new TagsModel();
        $tagsAll = $tagsModel->all();
        $articlesModel = new ArticlesModel();
        $articlesModel->page = $data['page'];
        $articlesModel->start = $pageLimitBlog * ($data['page'] - 1);//LIMIT start
        $articlesModel->limit = $pageLimitBlog;//LIMIT finish
        $articlesAll = $articlesModel->category($url);
        $smarty->assign('action', $action);
        $smarty->assign('url', $url);
        $smarty->assign('description', $description);
        $smarty->assign('tagsAll', $tagsAll);
        $smarty->assign('articlesAll', $articlesAll);
        $smarty->assign('categoryPage', $categoryPage);
        $smarty->assign('pagination', $data['pagination']);//пагинация
        $smarty->display('public/blog.tpl');
    }

    public function tag()
    {
        global $smarty;
        global $param;
        global $action;

        $url = trim(filter_var($param[0], FILTER_SANITIZE_STRING));
        $siteData = $this->menuPrincipal();
        $pageName = self::PAGE_NAME_TAG . '/' . $url; //для пагинации
        $pageLimitBlog = $siteData['pagelimit'];// колво статей на странице
        $tableName = self::TABLE_NAME;
        $this->menuCategory();
        $tagsModel = new TagsModel();
        $tagsAll = $tagsModel->all();
        foreach ($tagsAll as $tag) {
            if ($tag['url'] == $url) {
                $categoryPage = $tag["tag"];
                $description = 'Тег - ' . $tag["tag"];
            }
        }
        $data = $this->paginationBlog($pageName, $pageLimitBlog, $tableName, $categoryPage, true);
        $articlesModel = new ArticlesModel();
        $articlesModel->page = $data['page'];
        $articlesModel->start = $pageLimitBlog * ($data['page'] - 1);//LIMIT start
        $articlesModel->limit = $pageLimitBlog;//LIMIT finish
        $articlesAll = $articlesModel->tag($categoryPage);
        $smarty->assign('action', $action);
        $smarty->assign('url', $url);
        $smarty->assign('description', $description);
        $smarty->assign('tagsAll', $tagsAll);
        $smarty->assign('articlesAll', $articlesAll);
        $smarty->assign('categoryPage', $categoryPage);
        $smarty->assign('pagination', $data['pagination']);//пагинация
        $smarty->display('public/blog.tpl');

    }

    public function article()
    {
        global $param;
        global $smarty;
        global $action;

        $this->menuPrincipal();
        $categories = $this->menuCategory();
        $tagsModel = new TagsModel();
        $tagsAll = $tagsModel->all();
        $url = trim(filter_var($param[0], FILTER_SANITIZE_STRING));
        $articles = new ArticlesModel();
        $article = $articles->article($url);
        $categoryPage = $article['title'];
        foreach ($categories as $category) {
            if ($category['url'] == $article['category']) {
                $categoryArticle = $category['name'];
            }
        }
        $commentsModel = new CommentsModel();
        $commentsCount = $commentsModel->commentsCount($article['id']);
        $commentsDats = $commentsModel->commentsRead($article['id'], $parentID = 0);
        $comments = $this->getComments($commentsDats);

        $smarty->assign('action', $action);
        $smarty->assign('tagsAll', $tagsAll);
        $smarty->assign('categoryPage', $categoryPage);
        $smarty->assign('categoryArticle', $categoryArticle);
        $smarty->assign('article', $article);
        $smarty->assign('commentsCount', $commentsCount[0]);
        $smarty->assign('comments', $comments);
        $smarty->display('public/article.tpl');
    }

    public function getComments($commentsDats)
    {
        $commentsModel = new CommentsModel();
        foreach ($commentsDats as $commentsDat) {
            $comments [] = $this->commentsView($commentsDat);
            $commentsDats1 = $commentsModel->commentsRead($commentsDat['article_id'], $commentsDat['id']);
            if (!empty($commentsDats1)) {
                $comments [] = '<ul>';
                $comment = $this->getComments($commentsDats1);
                foreach ($comment as $commentParent) {
                    $comments [] = $commentParent;
                }
                $comments [] = '</ul>';
            }
            $comments [] = '</li>';
        }
        return $comments;
    }


}