<?php

use interfaces\ControllerInterface as Contriller;

class HomepageadmController implements Contriller
{

    public function index()
    {
        global $smarty;
        $frontContent = InfoModel::front();
        $smarty->assign('frontContent', $frontContent);
        $smarty->display('admin/homepage.tpl');
    }
}