<?php
use \interfaces\ControllerInterface as Controller;

class ArticlesadmController implements Controller
{

    public function index()
    {
        global $smarty;
        $articles = new ArticlesModel();
        $articles=$articles->all();
        $smarty->assign('articles',$articles);
        $smarty->display('admin/articles.tpl');
    }
}