<?php


trait errTrait
{
    private $error = '';

    /**
     * @return string
     */
    public function getErrImg()
    {
        $accepted = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_BMP, IMAGETYPE_ICO];
        global $error;
        switch (true) {
            case  $_FILES['file']['size'] > 2097152:
                $error = ' Размер файла привышает 2Мб';
                break;
            case  $_FILES['file']['size'] === 0:
                $error = ' Вы не выбрали картинку.';
                break;
            case  !in_array(exif_imagetype($_FILES['file']['tmp_name']), $accepted):
                //in_array — Проверяет, присутствует ли в массиве значение $accepted,
                // exif_imagetype считывает начальные байты изображения и проверяет их сигнатуру.
                $error = ' Недопустимый формат файла. Только jpeg, png, bmp, gif и ico';
                break;
        }
        return $error;
    }

    /**
     * @param null $login
     * @param null $pass
     * @param null $userName
     * @param null $mail
     * @param null $imgFile
     * @param null $rePass
     * @return string
     * На наличее переменной проверяем в джава и контроллере
     */
    public function getErrUser($login = null, $pass = null, $rePass = null, $userName = null, $mail = null)
    {
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

        }
        return $error;
    }

    public function getErrMenu($menu_name, $title, $description = null, $url = null)
    {
        global $error;
        switch (true) {
            case $menu_name && !preg_match("/^[a-zA-Z0-9_\-]{4,20}$/", $menu_name):
                $error = ' Административное название должно содержать не мение 4х символов, допустимы латинские буквы, цифры и символ "_"';
                break;
            case $title && strlen($title) < 4:
                $error = ' Название не моет быть короче 4х символов';
                break;
            case $description && strlen($description) < 10:
                $error = ' Описание не может быть короче 10ти символов';
                break;
            case $url && strlen($url) < 4:
                $error = ' URL не может быть короче 4х символов';
                break;
        }
        return $error;
    }

    public function getErrUpdate($column, $text)
    {
        switch (true) {
            case $column === 'title':
                $err = $this->getErrMenu($menu_name = null, $text, $description = null, $url = null);
                if ($err) {
                    $this->getResponse(['success' => false, 'err' => $err]);
                }
                break;
            case $column === 'description':
                $err = $this->getErrMenu($menu_name = null, $title = null, $text, $url = null);
                if ($err) {
                    $this->getResponse(['success' => false, 'err' => $err]);
                }
                break;
            case $column === 'url':
                $url = new Translite();
                $text = $url->cyrillic($text);
                $err = $this->getErrMenu($menu_name = null, $title = null, $description = null, $text);
                if ($err) {
                    $this->getResponse(['success' => false, 'err' => $err]);
                }
                return $text;
                break;
        }
    }

    public function getErrArticle($data)
    {
        global $error;
        switch (true) {
            case strlen($data['title']) < 6:
                $error = ' Заголовок не может быть мение 3х символов.';
                break;
            case strlen($data['intro']) < 30:
                $error = ' Описание не может быть мение 15 символов.';
                break;
            case strlen($data['text']) < 30:
                $error = ' Статья не может быть короче 15 символов.';
                break;
            case strlen($data['url']) < 8:
                $error = ' Ссылка не может быть короче 4 символов.';
                break;
            case empty($data['category']):
                $error = ' Вы не выбрали категорию';
                break;
            case empty($data['author']):
                $error = ' Укажите автора.';
                break;
            case strlen($data['alt']) < 8:
                $error = ' Alt не может быть короче 4 символов.';
                break;
            case empty($data['published']):
                $error = ' Не определина публикация.';
                break;
            case empty($data['front']):
                $error = ' Не определино размещение на главной.';
                break;
        }
        return $error;
    }


    //,

    public function getErrMail($name, $mail, $phone=null, $subject, $message)
    {
        global $error;

        switch (true){
            case empty($name):
                $error = ' Введите пожалуйста имя.';
                break;
            case !preg_match('/.+@.+\..+/i', $mail):
                $error = ' Введите действительный адрес электронной почты.';
                break;
            case $phone && !preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){9,14}(\s*)?$/', $phone):
                $error = ' Введите действительный номер телефона.';
                break;
            case empty($subject):
                $error = ' Укажите тему.';
                break;
            case empty($message):
                $error = ' Нельзя отправить пустое письмо.';
                break;

        }

        return $error;
    }

}