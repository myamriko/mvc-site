<?php

use \interfaces\ControllerInterface as Controller;

class CategoriesadmController implements Controller
{

    public function index()
    {
        global $smarty;
        $categories = new CategoriesModel();
        $categories=$categories->all();
        $smarty->assign('categories',$categories);
        $smarty->display('admin/categories.tpl');
    }
}