<?php

use \interfaces\ControllerInterface as Controller;

class InfoadmController implements Controller
{
    use ResponseTrait;
    use errTrait;

    public function index()
    {
        global $smarty;
        $siteData = Sitedata::info();//info сайта
        if (!$siteData) {
            die('Ошибка получения данных от info сайта ;(');
        }
        $smarty->assign('sitedata', $siteData);
        $smarty->display('admin/index.tpl');
    }

    public function update()

    {
        if (!empty($_FILES)) {
            $uploads_dir = '../public/pic/res'; //дериктория куда сохраняем
            $siteData=Sitedata::info();
            $oldIcoDir = $uploads_dir.'/'.$siteData[$_POST['column']];
            unlink($oldIcoDir);
            if (!is_dir($uploads_dir)) {
                mkdir($uploads_dir, 0777);
            };
            $tmp_file = $_FILES['file']['tmp_name'];
            $name_pic = trim(filter_var($_FILES['file']['name'], FILTER_SANITIZE_STRING));
            $translite = new Translite();
            $name_pic = $translite->cyrillic($name_pic);
            $err = $this->getErrUser($login = null, $pass = null, $rePass = null, $userName = null, $mail = null, $imgFile = true);// перечисляем все ибо иначе до картинки не доходит в трейте
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
            move_uploaded_file($tmp_file, "$uploads_dir/$name_pic");
            $info = new InfoadmModel();
            $info->text = $name_pic;
            $info->column = $_POST['column'];
            $info->update();
            $this->getResponse(['success' => $info, 'err' => 'Изменения не были внесены', 'name_pic'=>$name_pic]);
        }
        if (!empty($text = $_POST['text'])) {
            $info = new InfoadmModel();
            $info->text = filter_var(trim($text), FILTER_SANITIZE_STRING);
            $info->column = $_POST['column'];
            $info->update();
            $this->getResponse(['success' => $info, 'err' => 'Изменения не были внесены']);
        }
        $this->getResponse(['success' => false, 'err' => 'Вы не внесли изменения']);
    }


}