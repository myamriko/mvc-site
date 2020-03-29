<?php


trait errTrait
{


    private $error = '';

    /**
     * @param null $login
     * @param null $pass
     * @param null $userName
     * @param null $mail
     * @param null $imgFile
     * @param null $rePass
     * @return string
     * На наличее переменной проверяем с джава и контроллере
     */
    public function getErrUser($login=null, $pass=null,$rePass=null, $userName=null, $mail=null, $imgFile=null){
        $accepted = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_BMP, IMAGETYPE_ICO];
        global $error;

        switch (true) {//проверим передаваемые данные
            case $login && strlen($login) < 3:
                $error = ' Логин не может быть короче 3х символов.';
                break;
            case $pass && !preg_match('@^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{6,}$@', $pass):
                $error = ' Пароль должен содержать не мение 6-ти симолов,
                    хотябы одну строчную и одну заглавную ланитскую букву, одну цифру.';
                break;
            case $rePass && ($rePass != $pass):
                $error = ' Введенные пароли не совпадают.';
                break;
            case $userName && strlen($userName) < 3:
                $error = ' Имя не может быть короче 3-х символов.';
                break;
            case $mail && !preg_match('/.+@.+\..+/i', $mail):
                $error = ' Введите корректный адрес электронной почты';
                break;

            case  $imgFile && $imgFile > 2097152:
                $error = ' Размер файла привышает 2Мб';
                break;
            case  $imgFile && $_FILES['file']['size'] == 0:
                $error = ' Вы не выбрали картинку';
                break;
            case $imgFile && !in_array(exif_imagetype($_FILES['file']['tmp_name']), $accepted):
                //in_array — Проверяет, присутствует ли в массиве значение $accepted,
                // exif_imagetype считывает начальные байты изображения и проверяет их сигнатуру.
                $error = ' Недопустимый формат файла. Только jpeg, png, bmp, gif и ico';
                break;
        }
        return $error;
    }

}