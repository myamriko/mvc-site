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
                $error = ' Розмір файлу перевищує 2Мб';
                break;
            case  $_FILES['file']['size'] === 0:
                $error = ' Ви не обрали картинку.';
                break;
            case  !in_array(exif_imagetype($_FILES['file']['tmp_name']), $accepted):
                //in_array — Проверяет, присутствует ли в массиве значение $accepted,
                // exif_imagetype считывает начальные байты изображения и проверяет их сигнатуру.
                $error = ' Неприпустимий формат файлу, лише: jpeg, png, bmp, gif и ico';
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
        global $error;

        switch (true) {//проверим передаваемые данные
            case $login && strlen($login) < 3:
                $error = ' Логін не може бути коротше 3х символів.';
                break;
            case $pass && !preg_match('@^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w\s]).{6,}@', $pass):// заменить на ^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w\s]).{6,} со спец символами
                $error = ' Пароль повинен містіті не менш 6-ти сімолів, великі і малі
                        латинські літери, а також цифри та спеціальні символи.';
                break;
            case $rePass && ($rePass != $pass):
                $error = ' Введені паролі не співпадають.';
                break;
            case $userName && strlen($userName) < 2:
                $error = ' Ім\'я не може бути коротше 2-х символів.';
                break;
            case $mail && !preg_match('/.+@.+\..+/i', $mail):
                $error = ' Введите корректный адрес электронной почты';
                break;

        }
        return $error;
    }

    public function getErrUpdateUser($userName, $mail)
    {
        global $error;

        switch (true) {//проверим передаваемые данные

            case strlen($userName) < 3:
                $error = ' Ім\'я не може бути коротше 2-х символів.';
                break;
            case !preg_match('/.+@.+\..+/i', $mail):
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
                $error = ' Адміністративна назва має містити не меньше 4х символів, припустимі латинські літери, цифри та символ "_"';
                break;
            case $title && strlen($title) < 4:
                $error = ' Назва не може бути коротше 4х символів';
                break;
            case $description && strlen($description) < 10:
                $error = ' Опис не може бути коротше 10ти символів';
                break;
            case $url && strlen($url) < 4:
                $error = ' URL не може бути коротше 4х символів';
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
                $error = ' Заголовок не може бути меньше 3х символів.';
                break;
            case strlen($data['intro']) < 30:
                $error = 'Опис не може бути менше 15 символів.';
                break;
            case strlen($data['text']) < 30:
                $error = ' Стаття не може бути коротше за 15 символів.';
                break;
            case strlen($data['url']) < 8:
                $error = ' Посилання не може бути коротше 4 символів.';
                break;
            case empty($data['category']):
                $error = ' Ви не обрали категорію';
                break;
            case empty($data['author']):
                $error = ' Вкажіть автора.';
                break;
            case strlen($data['alt']) < 8:
                $error = ' Alt не може бути коротше 4 символів.';
                break;
            case empty($data['published']):
                $error = ' Не визначена публікація.';
                break;
            case empty($data['front']):
                $error = ' Не визначено розміщення на головній.';
                break;
        }
        return $error;
    }


    //,

    public function getErrMail($name, $mail = null, $phone = null, $subject, $message)
    {
        global $error;

        switch (true) {
            case empty($name):
                $error = ' Введіть будь ласка ім\'я.';
                break;
            case $mail && !preg_match('/.+@.+\..+/i', $mail):
                $error = ' Введіть дійсну адресу електронної пошти.';
                break;
            case $phone && !preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){9,14}(\s*)?$/', $phone):
                $error = ' Введіть дійсний номер телефону.';
                break;
            case empty($subject):
                $error = ' Вкажіть тему.';
                break;
            case empty($message):
                $error = ' Не слід відправити порожній лист.';
                break;

        }

        return $error;
    }

}