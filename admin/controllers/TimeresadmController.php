<?php

use \interfaces\ControllerInterface as Controller;

class TimeresadmController implements Controller
{
    use errTrait;
    use ResponseTrait;

    /**
     * @throws SmartyException
     *
     */
    public function index()
    {
        global $smarty;
        global $param;/*переключаем месяцы*/
        $mounts = [1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

        if ($param) {
            $mount = $param[0];
            $year = $param[1];
        } else {
            $mount = date('n');
            $year = date('o');
        }

        switch (true) {
            case $mount == 12:
                $nextMount = 1;
                $prevMount = $mount - 1;
                $nextYear = $year + 1;
                $prevYear = $year;
                break;
            case $mount == 1:
                $nextMount = $mount + 1;
                $prevMount = 12;
                $nextYear = $year;
                $prevYear = $year - 1;
                break;
            default :
                $nextMount = $mount + 1;
                $prevMount = $mount - 1;
                $nextYear = $year;
                $prevYear = $year;
                break;
        }
        $timeadmModel = new TimeresadmModel();
        $timeSettings = $timeadmModel->time_settings();

        $calendar = $this->drawCalendar($mount, $year);/*формируем таблицу в панеле с датами и временем*/
        $smarty->assign('prevMount', $prevMount);/*пагинация*/
        $smarty->assign('nextMount', $nextMount);
        $smarty->assign('nextYear', $nextYear);
        $smarty->assign('prevYear', $prevYear);

        $smarty->assign('mount', $mounts[$mount]);
        $smarty->assign('year', $year);
        $smarty->assign('calendar', $calendar);
        $smarty->assign('timeSettings', $timeSettings);
        $smarty->display('admin/calendar.tpl');
    }

    /**
     * @param $month
     * @param $year
     * @return string
     * таблица время дата в панели
     */
    public function drawCalendar($month, $year)
    {
        $monthYear = $month . '.' . $year;

        $timeRes = new TimeresadmModel();
        $timeData = $timeRes->makeDaysBypass($monthYear);
        if ($timeData === 'err') {
            die('Неверная дата, очистьте кеши и повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта.');
        }

        $calendar = '<table class="table table-mob"><thead class="thead-dark">';
        /* Заглавия в таблице */
        $headings = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
        $calendar .= '<tr class="calendar-row"><th class="calendar-day-head">' . implode('</th><th class="calendar-day-head">', $headings) . '</th></tr></thead>';
        /* необходимые переменные дней и недель... */
        $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
        if ($running_day == 0) {
            $running_day = 7;
        }
        $running_day = $running_day - 1;
        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        /* первая строка календаря */
        $calendar .= '<tr class="calendar-row">';
        /* вывод пустых ячеек в сетке календаря */
        for ($x = 0; $x < $running_day; $x++) {
            $calendar .= '<td class="calendar-day-np">&nbsp;</td>';
            $days_in_this_week++;
        }
        /* дошли до чисел, будем их писать в первую строку */
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++) {
            $calendar .= '<td  class="calendar-day"  data-label="' . $headings[date("w", mktime(0, 0, 0, $month, $list_day - 1, $year))] . '">';

            /* Пишем номер в ячейку */
            switch (true) {
                case $list_day == date('j'):
                    $calendar .= '<div class="day-number hoy">' . $list_day . '</div>';
                    break;
                case $list_day < date('j') && $month == date('n'):
                    $calendar .= '<div class="day-number ayer">' . $list_day . '</div>';
                    break;
                case $month < date('n'):
                    $calendar .= '<div class="day-number ayer">' . $list_day . '</div>';
                    break;
                default :
                    $calendar .= '<div class="day-number">' . $list_day . '</div>';
                    break;
            }
            /*выводим бронь в ячейку*/
            foreach ($timeData as $value) {
                if ($list_day == $value['day']) {
                    if ($value['note']) {
                        $calendar .= '<p><a class="link-note" onclick="noteRead(\'' . $value['id'] . '\')"><i class="fas fa-check-square"></i></a></p>';
                    }

                    switch (true) {
                        case $list_day < date('j') && $month == date('n') || $month < date('n'):
                            if ($value['action'] === 'yes') {
                                $calendar .= '<p id="visit-' . $value['id'] . '" class="old bg-yes-des removetime">' . $value['time'] . ' <b> ' . $value['name'] . '</b> ' . $value['tel'] . '</p>';
                            }
                            if ($value['action'] === 'no') {
                                $calendar .= '<p id="visit-' . $value['id'] . '" class="old bg-no-des removetime">' . $value['time'] . ' <b> ' . $value['name'] . '</b> ' . $value['tel'] . '</p>';
                            }
                            if ($value['action'] === 'undefined') {
                                $calendar .= '<p id="visit-' . $value['id'] . '" class="old bg-des removetime">' . $value['time'] . ' <b> ' . $value['name'] . '</b> ' . $value['tel'] . '</p>';
                            }

                            break;

                        default :
                            if ($value['action'] === 'yes') {
                                $calendar .= '<p id="visit-' . $value['id'] . '" class="bg-yes removetime">' . $value['time'] . ' <b> ' . $value['name'] . '</b> ' . $value['tel'] . '</p>';
                            }
                            if ($value['action'] === 'no') {
                                $calendar .= '<p id="visit-' . $value['id'] . '" class="bg-no removetime">' . $value['time'] . ' <b> ' . $value['name'] . '</b> ' . $value['tel'] . '</p>';
                            }
                            if ($value['action'] === 'undefined') {
                                $calendar .= '<p id="visit-' . $value['id'] . '" class="bg-ocupado removetime">' . $value['time'] . ' <b> ' . $value['name'] . '</b> ' . $value['tel'] . '</p>';
                            }

                    }
                }
            }
            $calendar .= '</td>';
            if ($running_day == 6) {
                $calendar .= '</tr>';
                if (($day_counter + 1) != $days_in_month) {
                    $calendar .= '<tr class="calendar-row">';
                }
                $running_day = -1;
                $days_in_this_week = 0;
            }
            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        }
        /* Выводим пустые ячейки в конце последней недели */
        if ($days_in_this_week != 1) {
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++) {
                $calendar .= '<td class="calendar-day-np">&nbsp;</td>';
            }
        }
        /* Закрываем последнюю строку */
        $calendar .= '</tr>';
        /* Закрываем таблицу */
        $calendar .= '</table>';
        /* Все сделано, возвращаем результат */
        return $calendar;
    }

    /**
     * удалить назначенное время
     */
    public function removedTime()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $timeResAdmMod = new TimeresadmModel();
            $timeExist = $timeResAdmMod->getTimeById($id);
            if (!$timeExist) {
                $this->getResponse(['success' => false, 'err' => 'В БД эта встреча не найдена, очистте кеш,
             обновите страничку и повторите попытку. Если ошибка повториться обратитесь к администратору сайта']);
            }

            $removedTime = $timeResAdmMod->removedTime($id);
            if (!$removedTime) {
                $this->getResponse(['success' => false, 'err' => 'Не удалось удалить бронь из БД, очистте кеш,
             обновите страничку и повторите попытку. Если ошибка повториться обратитесь к администратору сайта']);
            }
            $this->getResponse(['success' => true, 'id' => $id]);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришол пустой запрос, очистте кеш, обновите страничку 
        и повторите попытку. Если ошибка повториться обратитесь к администратору сайта']);

    }

    /**
     * настройки бронирования
     */
    public function editSettingTime()
    {

        $minTime = filter_var(trim($_POST["minTime"]), FILTER_SANITIZE_STRING);
        $maxTime = filter_var(trim($_POST["maxTime"]), FILTER_SANITIZE_STRING);
        $lunchStart = filter_var(trim($_POST["lunchStart"]), FILTER_SANITIZE_STRING);
        $lunchFinish = filter_var(trim($_POST["lunchFinish"]), FILTER_SANITIZE_STRING);
        $step = filter_var(trim($_POST["step"]), FILTER_SANITIZE_STRING);
        $disabledDates = filter_var(trim($_POST["disabledDates"]), FILTER_SANITIZE_STRING);
        $desabledWeekDays = filter_var(trim($_POST["desabledWeekDays"]), FILTER_SANITIZE_STRING);
        $day1 = filter_var(trim($_POST["day1"]), FILTER_SANITIZE_STRING);
        $day2 = filter_var(trim($_POST["day2"]), FILTER_SANITIZE_STRING);
        $day3 = filter_var(trim($_POST["day3"]), FILTER_SANITIZE_STRING);
        $day4 = filter_var(trim($_POST["day4"]), FILTER_SANITIZE_STRING);
        $day5 = filter_var(trim($_POST["day5"]), FILTER_SANITIZE_STRING);
        $day6 = filter_var(trim($_POST["day6"]), FILTER_SANITIZE_STRING);
        $day7 = filter_var(trim($_POST["day7"]), FILTER_SANITIZE_STRING);

        /** Проверка исключенных дней*/
        $disabledDates = preg_replace('/\s+/', '', $disabledDates);//удалить пробелы и табуляции
        $disabledDatesArr = explode(',', $disabledDates);
        $err = $this->getErrData($disabledDatesArr, 'Праздничные и исключенны дни');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $disabledDates = implode(",", $disabledDatesArr);

        /** Проверка времени */
        /*расписание*/
        $err = $this->getErrTime($minTime, $maxTime, 'рабочий день');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        /*перерыв*/
        $err = $this->getErrTime($lunchStart, $lunchFinish, 'перерыв');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }

        /** Интервал*/

        if ($step == 0) {
            $this->getResponse(['success' => false, 'err' => ' укажите интервал в диапзоне 1 - 480.']);
        }
        if ($step && !preg_match('/^[0-9]{1,3}$/', $step)) {
            $this->getResponse(['success' => false, 'err' => ' укажите интервал в диапзоне 1 - 480.']);
        }

        /** Исключенные часы в днях недели*/
        /*пондельник*/
        $day1 = preg_replace('/\s+/', '', $day1);//удалить пробелы и табуляции
        $day1 = explode(',', $day1);
        $err = $this->getErrTimeDay($day1, 'понедельник');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $day1 = implode(",", $day1);
        /*вторник*/
        $day2 = preg_replace('/\s+/', '', $day2);
        $day2 = explode(',', $day2);
        $err = $this->getErrTimeDay($day2, 'вторник');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $day2 = implode(",", $day2);
        /*среда*/
        $day3 = preg_replace('/\s+/', '', $day3);
        $day3 = explode(',', $day3);
        $err = $this->getErrTimeDay($day3, 'среда');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $day3 = implode(",", $day3);
        /*четверг*/
        $day4 = preg_replace('/\s+/', '', $day4);
        $day4 = explode(',', $day4);
        $err = $this->getErrTimeDay($day4, 'четверг');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $day4 = implode(",", $day4);
        /*пятница*/
        $day5 = preg_replace('/\s+/', '', $day5);
        $day5 = explode(',', $day5);
        $err = $this->getErrTimeDay($day5, 'пятница');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $day5 = implode(",", $day5);
        /*суббота*/
        $day6 = preg_replace('/\s+/', '', $day6);
        $day6 = explode(',', $day6);
        $err = $this->getErrTimeDay($day6, 'пятница');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $day6 = implode(",", $day6);
        /*воскресенье*/
        $day7 = preg_replace('/\s+/', '', $day7);
        $day7 = explode(',', $day7);
        $err = $this->getErrTimeDay($day7, 'воскресенье');
        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $day7 = implode(",", $day7);

        $timeData = [
            'day-1' => $day1,
            'day-2' => $day2,
            'day-3' => $day3,
            'day-4' => $day4,
            'day-5' => $day5,
            'day-6' => $day6,
            'day-7' => $day7,
            'step' => $step,
            'desabled-week-days' => $desabledWeekDays,
            'disabled-dates' => $disabledDates,
            'min-time' => $minTime,
            'max-time' => $maxTime,
            'lunch-start' => $lunchStart,
            'lunch-finish' => $lunchFinish
        ];

        /**
         * обновляем настройки бронирования
         */
        $updateTimeSettig = new TimeresadmModel();
        $updateTimeSettig = $updateTimeSettig->updateTimeSetting($timeData);
        $this->getResponse(['success' => $updateTimeSettig, 'err' => 'Изменения не были внесены.']);

    }

    /**
     * Таблица брони, выделение
     */
    public function bookingAction()
    {

        $id = str_replace('visit-', '', filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING));
        $action = filter_var(trim($_POST['action']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $timeResAdmModel = new TimeresadmModel();
            $bookingAction = $timeResAdmModel->bookingAction($id, $action);
            $this->getResponse(['success' => $bookingAction, 'err' => 'Не удалось внести изменения в БД']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос, пожалуйста очистьте кеш и 
        обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
    }

    /**
     * Примечания к брони, получить из БД
     */
    public function readNote()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $timeResAdmModel = new TimeresadmModel();
            $note = $timeResAdmModel->readNote($id);
            $this->getResponse(['success' => (bool)$note, 'note' => $note['note'], 'err' => 'Не удалось внести изменения в БД']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос, пожалуйста очистьте кеш и 
        обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
    }

    /**
     * Обновить примечание
     */
    public function updateNote()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        $note = filter_var(trim($_POST['note']), FILTER_SANITIZE_STRING);
        if (!empty($id)){
            $timeResAdmModel = new TimeresadmModel();
            $noteUpdate = $timeResAdmModel->updateNote($id, $note);
            $this->getResponse(['success' =>$noteUpdate , 'note' => $note, 'err' => 'Не удалось внести изменения в БД']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пришел пустой запрос, пожалуйста очистьте кеш и 
        обновите страницу. Если ошибка повторится свяжитесть с администратором сайта.']);
    }

    /**
     * Удалить Примечание
     */
    public function removeNote()
    {

    }

}