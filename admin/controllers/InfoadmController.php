<?php

use \interfaces\ControllerInterface as Controller;

class InfoadmController implements Controller
{
    use ResponseTrait;
    use errTrait;
    use UploadTrait;

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
        $siteData = Sitedata::info();
        if (!empty($_FILES)) {
            $uploads_dir = '../public/pic/res'; //дериктория куда сохраняем
            $oldIcoDir = $uploads_dir . '/' . $siteData[$_POST['column']];
            if (file_exists($oldIcoDir)) {
                unlink($oldIcoDir);//удаляем старый фаил
            }
            $name_pic=$this->uploadPic($uploads_dir);//трейт загрузки
            $info = new InfoadmModel();
            $info->text = $name_pic;
            $info->column = $_POST['column'];
            $info = $info->update();
            $this->getResponse(['success' => $info, 'err' => 'Вы не внесли изменения при редактировании.', 'name_pic' => $name_pic, 'name_pic_old' => $siteData[$_POST['column']]]);
        }
        if (!empty($text = $_POST['text'])) {
            $info = new InfoadmModel();
            $info->text = filter_var(trim($text), FILTER_SANITIZE_STRING);
            $info->column = $_POST['column'];
            $info = $info->update();
            $this->getResponse(['success' => $info, 'err' => 'Вы не внесли изменения при редактировании.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Вы не внесли изменения при редактировании.', 'name_pic_old' => $siteData[$_POST['column']]]);
    }
}