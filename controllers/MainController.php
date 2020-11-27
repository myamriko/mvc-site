<?php

use \interfaces\ControllerInterface as Controller;

class MainController implements Controller
{

    use ViewsTrait;

    /**
     * @throws SmartyException
     * Главная
     */
    public function index()
    {
        global $smarty;
        
        /* Бронирование времени */
        $minDate = 0;
        $timeSettings = new TimeresadmModel();
        $timeSettings = $timeSettings->time_settings();
        $disabledDates = $timeSettings['disabled-dates'];
        $disabledDates = "'" . preg_replace("/\,/", "','", $disabledDates) . "'";// добавим кавыки
        $disabledWeekDays = $timeSettings['desabled-week-days'];
        $minTime = "'" . $timeSettings['min-time'] . "'";
        $maxTime = "'" . $timeSettings['max-time'] . "'";
        if (strtotime($timeSettings['max-time']) <= time()) {
            $d = strtotime("+1 day");
            $day = date("d.m.Y", $d);// выводим завтрашний день
            $minDate = "'" . $day . "'";
        }
        $step = $timeSettings['step'];
        /* Бронирование времени */
        $siteData = InfoModel::info();
        $lastArticles = WidgetModel::lastArticle();
        $this->menuPrincipal();
        $description = $siteData['propaganda'];
        $front = InfoModel::front();

        $smarty->assign('siteData', $siteData);
        $smarty->assign('lastArticles', $lastArticles);
        $smarty->assign('description', $description);
        $smarty->assign('front', $front);
        /* Бронирование времени */
        $smarty->assign('disabledDates', $disabledDates);
        $smarty->assign('disabledWeekDays', $disabledWeekDays);
        $smarty->assign('minDate', $minDate);
        $smarty->assign('minTime', $minTime);
        $smarty->assign('maxTime', $maxTime);
        $smarty->assign('step', $step);
        /* Бронирование времени */
        $smarty->display('public/index.tpl');
    }

}