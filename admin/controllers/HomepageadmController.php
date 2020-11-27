<?php

use interfaces\ControllerInterface as Contriller;

class HomepageadmController implements Contriller
{

    public function index()
    {
        global $smarty;
        $front = InfoModel::front();
        $smarty->assign('front', $front);
        $smarty->display('admin/homepage.tpl');
    }
}