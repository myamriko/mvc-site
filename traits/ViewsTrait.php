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

    /**
     * комментарии
     * @param $commentsDat
     * @param $userAvatar
     * @return string
     */
    public function commentsView($commentsDat, $userAvatar, $articleId, $articleTitle)
    {

        $comments = '
<li id="' . $commentsDat['id'] . '">
    <div id="add-' . $commentsDat['id'] . '"  class="comment-list">
        <div class="single-comment justify-content-between d-flex">
            <div class="user justify-content-between d-flex">
                <div class="thumb">';
        if ($userAvatar) {
            $comments .= ' <img src="/public/pic/avatar/' . $userAvatar . '">';
        } else {
            $comments .= ' <img src="/public/pic/avatar/anonimus.png">';
        }

        $comments .= ' </div>
                <div class="desc">
                    <p id="text-' . $commentsDat['id'] . '" class="comment">
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
                <p id="date-' . $commentsDat['id'] . '" class="date">' . date("Y-m-d H:i", strtotime($commentsDat['date'])) . ' </p>
            </div>
            <div class="reply-btn">  
            <div class="row">';
        if ($_SESSION['user']['role'] === 'admin') {
            $comments .= ' <a class="btn btn-del text-uppercase" onclick="remComment(\'' . $commentsDat['id'] . '\', \''.$articleTitle. '\')">вилучити</a>
                           <a class="btn btn-edit text-uppercase" onclick="editComment(\'' . $commentsDat['id'] . '\',\'' . $commentsDat['username'] . '\',\'' . $_SESSION['user']['username'] . '\',\'' . $articleTitle . '\')">редагувати</a>';
        } else if ($_SESSION['user']['username'] === $commentsDat['username'] && $_SESSION['user']['username']) {
            $comments .= ' <a class="btn btn-del text-uppercase" onclick="remComment(\'' . $commentsDat['id'] . '\', \''.$articleTitle. '\')">вилучити</a>
                           <a class="btn btn-edit text-uppercase" onclick="editComment(\'' . $commentsDat['id'] . '\',\'' . $commentsDat['username'] . '\',\'' . $_SESSION['user']['username'] . '\',\'' . $articleTitle . '\')">редагувати</a>';
        }
        $comments .= '<a id="btn-reply-' . $commentsDat['id'] . '" class="btn btn-reply text-uppercase" onclick="reply(\'' . $commentsDat['id'] . '\',\'' . $commentsDat['username'] . '\',\'' . $_SESSION['user']['username'] . '\',\'' . $articleId . '\',\'' . $articleTitle . '\',\'' . $_SESSION['user']['id'] . '\')">відповісти</a>
                </div>
            </div>
        </div>
    </div>';
        return $comments;
    }

}