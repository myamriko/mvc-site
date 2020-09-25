<?php


trait ViewsTrait
{
    public function menuPrincipal()
    {
        global $smarty;
        global $controller;
        $links = [];
        $siteData = InfoModel::info();
        $menus = new MenuModel();
        $menu = $menus->menu();
        foreach ($menu as $value) {
            if ($value['enabled'] === 'ON') {
                $menus->menuName = $value['menu_name'];
                array_push($links, $menus->link());
            }
        }
        $controller = lcfirst(str_replace('Controller', '', $controller));
        $smarty->assign('controller', $controller);
        $smarty->assign('sitedata', $siteData);
        $smarty->assign('menu', $menu);
        $smarty->assign('links', $links);
        return $siteData;
    }

    public function menuCategory()
    {
        global $smarty;
        $categories = new CategoriesModel();
        $categories = $categories->all();
        $smarty->assign('categories', $categories);
        return $categories;
    }

    public function commentsView($commentsDat)
    {
        $comments = '
<li>
    <div class="comment-list">
        <div class="single-comment justify-content-between d-flex">
            <div class="user justify-content-between d-flex">
                <div class="thumb">
                    <img src="/public/pic/avatar/anonimus.png">
                </div>
                <div class="desc">
                    <p class="comment">
                       ' . $commentsDat['mess'] . '
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h5>
                    <em style="color: #607e89; font-weight: 600;">' . $commentsDat['username'] . '</em>
                </h5>
                <p class="date">' . date("Y-m-d H:i", strtotime($commentsDat['date'])) . ' </p>
            </div>
            <div class="reply-btn">
                <a href="#" class="btn-reply text-uppercase">відповісти</a>
            </div>
        </div>
    </div>';
        return $comments;
    }

}