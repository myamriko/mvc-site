<?php

use \interfaces\ControllerInterface as Controller;

class MainController implements Controller
{
    public function index()
    {
        global $smarty;
        $sitedata = InfoModel::info();

        $smarty->assign('sitedata',$sitedata);
        $smarty->display('public/index.tpl');
    }

}