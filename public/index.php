<?php
require_once('../smarty/libs/Smarty.class.php');
require_once('../interfaces/ControllerInterface.php');
require_once ('../vendor/autoload.php');

spl_autoload_register(function ($class) {
    $patch = '../%s/' . $class . '.php';

    switch (true) {
        case strpos($class, 'admController'):
            $patch = sprintf($patch, 'admin/controllers');
            break;
        case strpos($class, 'admModel'):
            $patch = sprintf($patch, 'admin/models');
            break;
        case strpos($class, 'Controller')://что-бы разделить классы controller и Models ищим первое вхождение в строку strpos
            $patch = sprintf($patch, 'controllers');// подставляем в шаблон аргумент controllers вместо %S
            break;
        case strpos($class, 'Model'):
            $patch = sprintf($patch, 'models');
            break;
        case strpos($class, 'Trait'):
            $patch = sprintf($patch, 'traits');
            break;

        default :
            $patch = sprintf($patch, 'classes');
            break;
    }

    (file_exists($patch)) ? require_once($patch) : die('404 ' . $class . ' not fount!');
});
/*smarty*/
$smarty = new Smarty();//создаем класс смарти
$smarty->setTemplateDir('../views');//указываем где будут находиться файлы шаблонизатора
/*Старт сессия*/
Session::start();
/*Роутер*/
$urlData = ltrim($_SERVER['REQUEST_URI'], '/');
$urlData = explode('?', $urlData);
$urlData = array_shift($urlData);
$arrUrl = explode('/', $urlData);
$controller = ($arrUrl == [""] || !$arrUrl) ? 'MainController' : str_replace('-', '', ucfirst(array_shift($arrUrl))) . 'Controller';
$action = ($arrUrl == [""] || !$arrUrl) ? 'index' : array_shift($arrUrl);

$param = ($arrUrl) ?: [];

//проверка на админа

if (strpos($controller, 'admController') && Session::get('user', ['role' => ''])['role'] !== 'admin') {
    header('Location: /');
    die('404 - не завезли таких страниц ');//если контроллер Admin а пользователь не admin ошибка доступа 404
}
$controllerObj = new $controller();
if (!method_exists($controllerObj, $action)) {
    die('404 ' . $action . ' method not exists');
}
$controllerObj->$action();
die();



