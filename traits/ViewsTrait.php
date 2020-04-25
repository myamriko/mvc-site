<?php


trait ViewsTrait
{
    public function menuPrincipal()
    {
        global $smarty;
        global $controller;
        $links=[];
        $siteData = InfoModel::info();
        $menus = new MenuModel();
        $menu = $menus->menu();
        foreach ($menu as $value) {
            if ($value['enabled'] === 'ON') {
                $menus->menuName = $value['menu_name'];
                array_push($links,$menus->link());
            }
        }
        $controller=lcfirst(str_replace('Controller', '', $controller));
        $smarty->assign('controller',  $controller);
        $smarty->assign('sitedata', $siteData);
        $smarty->assign('menu', $menu);
        $smarty->assign('links', $links);
    }

}