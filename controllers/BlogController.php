<?php

use \interfaces\ControllerInterface as Controller;


class BlogController implements Controller
{
    use ViewsTrait;
    use ResponseTrait;
    use errTrait;
    use ExtraTrait;

    public function index()
    {
        global $smarty;
        $this->menuPrincipal();
        $smarty->display('public/blog.tpl');

    }
}