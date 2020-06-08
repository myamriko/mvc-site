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

    public function report($report){
        $reports = [];
        foreach ($report as $index => $value) {
            $reports[$index]['id'] = $value['id'];
            $reports[$index]['err'] = $value['err'];
            $reports[$index]['date'] = $value['date'];
            $reports[$index]['resend'] = $value['resend'];
            $dataJson = json_decode($report[$index]['message'], true);
            $reports[$index]['name'] = $dataJson['name'];
            $reports[$index]['mailTo'] = $dataJson['mailTo'];
            $reports[$index]['phone'] = $dataJson['phone'];
            $reports[$index]['subject'] = $dataJson['subject'];
            $reports[$index]['message'] = $dataJson['message'];
        }
        return $reports;
    }

    public function captcha(){
        $siteData = InfoModel::info();
        $Response = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$siteData['sekretkey']."&response={$_POST['g_recaptcha_response']}");
        $Return = json_decode($Response);
        return $Return;
    }

}