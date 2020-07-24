<?php

use \interfaces\ControllerInterface as Controller;

class MainController implements Controller
{

    use ViewsTrait;

    public function index()
    {
        global $smarty;
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

        $this->menuPrincipal();
        $smarty->assign('disabledDates', $disabledDates);
        $smarty->assign('disabledWeekDays', $disabledWeekDays);
        $smarty->assign('minDate', $minDate);
        $smarty->assign('minTime', $minTime);
        $smarty->assign('maxTime', $maxTime);
        $smarty->assign('step', $step);
        $smarty->display('public/index.tpl');
    }

}