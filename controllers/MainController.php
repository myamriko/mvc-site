<?php

use \interfaces\ControllerInterface as Controller;

class MainController implements Controller
{
    public function index()
    {
        global $smarty;
        $sitedata = Sitedata::info();

        $smarty->assign('sitedata',$sitedata);

        $smarty->display('public/index.tpl');

    }

}