<?php


class PageadmController
{
    use ResponseTrait;
    use errTrait;

    public function update()

    {

        if (!empty($text = $_POST['text'])) {
            $info = new PageadmModel();
            $info->cacheName=$_POST['cacheName'];
            $text=filter_var(trim($text), FILTER_SANITIZE_STRING);
            $info->column = $_POST['column'];
            $info->text = $text;
            $info = $info->update();
            $this->getResponse(['success' => $info, 'err' => 'Изменения не были внесены.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Изменения не были внесены.']);
    }

}