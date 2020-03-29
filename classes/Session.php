<?php


class Session
{
    /**
     * запуск сессии
     */
    public static function start()
    {
        if (isset($_COOKIE['session_id'])) {
            session_id($_COOKIE['session_id']);
            session_start();

        } else {
            session_start();
            setcookie('session_id', session_id());
        }

    }

    /**
     * @param $kay - зарегестрированный пользователь
     * @param $value - данные пользователя из UserModel/loginUser()
     */
    public static function set($kay, $value)
    {
        $_SESSION[$kay] = $value;

    }

    /**
     * @param $kay
     * @param null $default
     * @return mixed|null
     */
    public static function get($kay, $default = null)
    {
        return !empty($_SESSION[$kay]) ? $_SESSION[$kay] : $default;

    }

    /**
     * @param $kay
     *  Удаляет значения из сессии, (карзину чистит)
     */

    public static function remove($kay)
    {
        unset($_SESSION[$kay]);
    }

    /**
     * выйти
     */

    public static function flash()
    {
        session_destroy();
    }

    /**
     * @return bool
     * Проверим залогинен ли пользователь
     */

    public static function checkUserOut()
    {
        return !is_null(Session::get('user', null));
    }

}