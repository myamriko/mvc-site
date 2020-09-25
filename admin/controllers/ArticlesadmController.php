<?php

use \interfaces\ControllerInterface as Controller;

class ArticlesadmController implements Controller
{
    const DIR_UPLOAD = '../public/pic/img-art';
    const TABLE_NAME = 'articles';
    const PAGE_NAME = 'articles-adm/index';
    use errTrait;
    use ResponseTrait;
    use UploadTrait;
    use ArticleTrait;
    use ExtraTrait;

    public function index()
    {
        global $smarty;

        $pageName = self::PAGE_NAME; //для пагинации
        $pageLimit = new PageadmModel();//лимит на страние
        $articleLimit=$pageLimit->pageLimit();
        $articleLimit = $articleLimit['pageLimitArticlePanel'];// колво ссылок на странице
        $tableName = self::TABLE_NAME;
        $data = $this->pagination($pageName,$articleLimit,$tableName);
        $articles = new ArticlesadmModel();
        $articles->page=$data['page'];
        $articles->start = $articleLimit * ($data['page'] - 1);//LIMIT start
        $articles->limit = $articleLimit;//LIMIT finish
        $article = $articles->all();
        $articlesTitleSearch = new ArticlesModel();// для autoload при поиске
        $articlesTitleSearch = $articlesTitleSearch->all();
        $hint = $this->hint($articlesTitleSearch, 'title');
        $categories = new CategoriesModel();
        $categories = $categories->all();
        $tags = new TagsModel();// доля autoload при поиске
        $tags = $tags->all();
        $tagSearch = $this->hint($tags, 'tag');
        $hint = $hint . ',' . $tagSearch;
        $smarty->assign('articleLimit', $articleLimit);
        $smarty->assign('hint', $hint);//подсказки в окне поиска
        $smarty->assign('categories', $categories);
        $smarty->assign('articles', $article);
        $smarty->assign('pagination', $data['pagination']);//пагинация
        $smarty->display('admin/articles.tpl');
    }

    public function add()
    {

        $data = $this->setData();
        $file = $this->uploadPic(self::DIR_UPLOAD);//загрузка картинки
        $data = $data + ['file' => $file];
        $addArticle = new ArticlesadmModel();
        $addArticle = $addArticle->add($data);
        $this->getResponse(['success' => $addArticle, 'err' => 'Не удалось внести новую статью в БД.', 'url' => $data['url'], 'file' => $file, 'tags' => $data['tags']]);
    }

    public function edit()
    {
        if (!empty($id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING))) {
            $articles = new ArticlesadmModel();
            $articles->id = $id;
            $article = $articles->getArticle();
            if (!$article) {
                $this->getResponse(['success' => false, 'err' => ' Такой статьи не существует, 
                пожалуйста очистьте кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
            }
            $this->getResponse([
                'success' => true,
                'title' => $article['title'],
                'url' => $article['url'],
                'intro' => $article['intro'],
                'text' => $article['text'],
                'category' => $article['category'],
                'name' => $article['name'],
                'tags' => $article['tags'],
                'file' => $article['file'],
                'alt' => $article['alt'],
                'author' => $article['author'],
                'published' => $article['published'],
                'front' => $article['front']
            ]);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос, пожалуйста очистьте кеш и 
        обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
    }

    public function update()
    {
        $data = $this->setData();
        if ($_FILES) {
            $err = $this->getErrImg();
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
            $oldFile = self::DIR_UPLOAD . '/' . $data['oldFile'];
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
            $file = $this->uploadPic(self::DIR_UPLOAD);//загрузка картинки
            $data = $data + ['file' => $file];

        } else {
            $data = $data + ['file' => $data['oldFile']];
        }

        $article = new ArticlesadmModel();
        $article->id = $data['id'];
        $articleExist = $article->getArticle();
        if (!$articleExist) {
            $this->getResponse(['success' => false, 'err' => ' Такой статьи не существует, 
                пожалуйста очистьте кеш, обновите страницу и повторите попытку. Если ошибка повторится свяжитесть с администратором сайта.']);
        }

        $articleEdit = $article->edit($data);
        $this->getResponse(['success' => $articleEdit, 'err' => 'Не удалось внести зменения в БД.', 'url' => $data['url'], 'file' => $data['file'], 'tags' => $data['tags'], 'category' => $data['category']]);
    }

    public function removed()
    {
        if (!empty($id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING))) {
            $articles = new ArticlesadmModel();
            $articles->id = $id;
            $checkArticles = $articles->getArticle();
            if (!$checkArticles) {
                $this->getResponse(['success' => false, 'err' => ' Такой статьи не существует, 
                пожалуйста очистьте кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
            }

            $removedArticle = $articles->removed();
            if (!$removedArticle) {
                $this->getResponse(['success' => $removedArticle, 'err' => 'Статья не была удален из БД, пожалуйста очистьте
            кеш, обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
            }
            $uploads_dir = '../public/pic/img-art'; //дериктория куда сохраняем
            $img = $uploads_dir . '/' . $checkArticles['file'];
            if (file_exists($img)) {
                unlink($img);//удаляем фаил
            };

            $this->getResponse(['success' => $removedArticle]);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос на удаление, пожалуйста очистьте кеш, 
        обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
    }
}