<?php


trait UploadTrait
{
    public function uploadPic($uploads_dir)
    {
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777);
        };
        $tmp_file = $_FILES['file']['tmp_name'];
        $name_pic = trim(filter_var($_FILES['file']['name'], FILTER_SANITIZE_STRING));
        $translite = new Translite();
        $name_pic = $translite->cyrillic($name_pic);
        $nameArr = explode('.', $name_pic);
        $name_pic = array_shift($nameArr);
        $name_pic = $name_pic . '-' . rand(0, 999) . '.' . $nameArr[0];
        move_uploaded_file($tmp_file, "$uploads_dir/$name_pic");
        return $name_pic;
    }
}