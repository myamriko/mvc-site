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
        $siteData = InfoModel::info();//info сайта
        if (!$siteData) {
            die('Ошибка получения данных от info сайта ;(');
        }
        $smarty->assign('sitedata', $siteData);
        $smarty->display('admin/index.tpl');
    }

    /**
     *
     */
    public function update()

    {
        $siteData = InfoModel::info();
        if (!empty($_FILES)) {
            $uploads_dir = '../public/pic/res'; //дериктория куда сохраняем
            $oldIcoDir = $uploads_dir . '/' . $siteData[$_POST['column']];
            $err = $this->getErrImg();
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err, 'name_pic_old' => $siteData[$_POST['column']]]);
            }
            $name_pic=$this->uploadPic($uploads_dir);//трейт загрузки
            if (file_exists($oldIcoDir)) {
                unlink($oldIcoDir);//удаляем старый фаил
            }
            $info = new InfoadmModel();
            $info->text = $name_pic;
            $info->column = $_POST['column'];
            $info = $info->update();
            $this->getResponse(['success' => $info, 'err' => 'Изменения не были внесены.', 'name_pic' => $name_pic, 'name_pic_old' => $siteData[$_POST['column']]]);
        }
        if (!empty($text = $_POST['text'])) {
            $info = new InfoadmModel();
            $text=filter_var(trim($text), FILTER_SANITIZE_STRING);
            $info->cacheName=$_POST['cacheName'];
            $info->column = $_POST['column'];
            if ($info->column === 'pss_admin'){
                $encrypts = new Encrypt();
                $text=$encrypts->dsCrypt($text);
            }
            $info->text = $text;
            $info = $info->update();
            $this->getResponse(['success' => $info, 'err' => 'Изменения не были внесены.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Изменения не были внесены.', 'name_pic_old' => $siteData[$_POST['column']]]);
    }
}