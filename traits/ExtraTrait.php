<?php


trait ExtraTrait
{
    public function hint($tags,$column){
        $hint = '';
        foreach ($tags as $tag) {
            $hint = $hint . ',' . '"' . $tag[$column] . '"';
        }
        return $hint = trim($hint, ',');//передаем страку в js для автозаполнения
    }

    public function pagination($pageName,$articleLimit,$tableName){
        global $param;
        !empty($param) ? $page = filter_var(trim($param[0]), FILTER_SANITIZE_NUMBER_INT) : $page = 1;
        $pageMode = new PageModel();//всего статей в базе
        $pageMode->tableName = $tableName;
        $countArticlesTotal = $pageMode->allArticle();
        $countPageTotal = ceil($countArticlesTotal / $articleLimit);
        switch (true) {
            case $page < 0:
                $page = 1;
                break;
            case $page > $countPageTotal;
                $page = $countPageTotal;
                break;
        }
        $pageMode->pageName = $pageName;
        $pageMode->page = $page;
        $pageMode->countPageTotal = $countPageTotal;
        $pagination = $pageMode->pagination();
        $data=[
            'pagination'=>$pagination,
            'page'=>$page
        ];
        return $data;
    }

}