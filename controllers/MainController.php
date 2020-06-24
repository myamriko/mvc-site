<?php

use \interfaces\ControllerInterface as Controller;

class MainController implements Controller
{

    use ViewsTrait;

    public function index()
    {
        
        global $smarty;
        $this->menuPrincipal();
        $smarty->display('public/index.tpl');
    }

}