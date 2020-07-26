<?php


class TimeresController
{
    use ResponseTrait;
    use ExtraTrait;

    /**
     * Формируем массив разрешенного времени allowTimes
     * allowMinTimes - минимальное разрешенное время, если бронь сегодня.
     */
    public function callday()
    {

        $day = filter_var(trim($_POST['day']), FILTER_SANITIZE_STRING);
        if (!empty($day)) {
            $timeSettings = new TimeresadmModel();
            $timeSettings = $timeSettings->time_settings();
            $minTime = $timeSettings['min-time'];//minTime день начало
            $minTimeUnt = strtotime($minTime);//minTime
            $maxTime = $timeSettings['max-time'];//maxTime день конец
            $lunchStart = $timeSettings['lunch-start'];//обед начало
            $lunchStartUnt = strtotime($lunchStart);//
            $lunchFinish = $timeSettings['lunch-finish'];//обед начало
            $step = $timeSettings['step'];//step
            $times[] = $minTime;//массив разрешенного времени
            $hoursBusy = [];//занятые часы
            $monthYearArr = explode(' ', $day);
            $monthYear = $monthYearArr[1];
            if (strlen($day) === 11) {
                $dayNumber = $monthYearArr[2];
            } else {
                $dayNumber = $monthYearArr[3];
            }
            /**
             * Исключенные из расписания часы
             */
            $dayOfWeek = $timeSettings['day-' . $dayNumber];
            if ($dayOfWeek) {
                $dayOfWeek = explode(',', $dayOfWeek);
                $hoursBusy = $dayOfWeek;
            }
            /**
             * Обед
             */
            if (!empty($lunchStart) && !empty($lunchFinish)) {
                if ((int)$step > 15) {
                    $stepLanch = 15;
                } else {
                    $stepLanch = $step;
                }
                $lunch = $this->allowTimes($lunchFinish, $stepLanch, $lunchStartUnt, $lunchStart);// массив времени обед
                array_unshift($lunch, $lunchStart);
                $hoursBusy = array_merge($hoursBusy, $lunch);
            }
            $allowTimes = new TimeresModel();
            $timeReses = $allowTimes->busyTime($monthYear);
            foreach ($timeReses as $timeRes) {
                if ($timeRes['day'] == $monthYearArr[0]) {
                    $hoursBusy[] = $timeRes['time'];
                }
            }
            $times = $this->allowTimes($maxTime, $step, $minTimeUnt, $minTime);
            $times = array_diff($times, $hoursBusy);
            $allowTimes = explode(',', implode(",", $times));
            array_unshift($allowTimes, $minTime);
            $minTimeUnt = strtotime($_POST['minTime']);
            $monthYearArr = explode(' ', $day);
            if ($monthYearArr[0] == date('j') && $minTimeUnt < strtotime(date('H:i'))) {
                $allowMinTimes = "'" . date('H:i') . "'";
            }
            $this->getResponse(['success' => true, 'allowTimes' => $allowTimes, 'allowMinTimes' => $allowMinTimes]);
        }
        $this->getResponse(['success' => false, 'err' => ' Прийшов порожній запит, поновіть сторінку і спробуйте ще раз.']);

    }

    public function booking()
    {

        $allDate = filter_var(trim($_POST['timeDate']), FILTER_SANITIZE_STRING);
        $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
        $phone = filter_var(trim($_POST['phone']),FILTER_SANITIZE_STRING);

        if (!empty($allDate) && !empty($name)){
            $allDateArr = explode(' ', $allDate);
            $monthYear = $allDateArr[1];
            $timeresModel = new TimeresModel();
            $timeReses = $timeresModel->busyTime($monthYear);
            foreach ($timeReses as $timeRes) {
                if ($timeRes['day'] == $allDateArr[0] && $timeRes['time'] == $allDateArr[2]) {
                    $this->getResponse(['success' => false, 'err'=> 'На жаль, цей час тільки що хтось зайнявю. поновіть сторінку і спробуйте ще раз.']);
                }
            }

            $addBookingTime = $timeresModel->bookingTime($allDateArr, $name, $phone);
            if ($addBookingTime){
                if ($phone){
                    $phone = ' телефон '.$phone;
                }
                Telegram::sender($name.' забронював(ла) зустріч '.$allDateArr[0].'.'.$allDateArr[1].' о '.$allDateArr[2].$phone);
            }

            $this->getResponse(['success' => $addBookingTime, 'err' => 'Не вдалося призначити зустріч, поновіть сторінку і спробуйте ще раз, або зв\'яжіться з нами за допомогою контактної форми.']);
        }

        $this->getResponse(['success' => false, 'err' => ' Прийшов порожній запит, поновіть сторінку і спробуйте ще раз.']);
    }


}