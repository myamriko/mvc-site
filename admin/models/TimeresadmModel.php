<?php


class TimeresadmModel
{

    /**
     * @param $monthYear
     * @return array|null
     * выбираем забронированное время в базе для таблицы в панеле
     */

    public function makeDaysBypass($monthYear)
    {
        if (!preg_match('/(?<=^| )\d+\.\d+(?=$| )/', $monthYear)) {
            return 'err';
        }
        $query = 'SELECT * FROM `time-res` WHERE `month-year` LIKE ? ORDER BY `time` ASC ';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([$monthYear]);
        $timeRes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $timeRes;
    }

    /**
     * @return mixed
     * получаем настройки времени для брони
     */
    public function time_settings()
    {
        $query = 'SELECT * FROM `time-res-settings`';
        $dbh = DB::getInstance();
        $res = $dbh->query($query);
        $timeSettings = $res->fetch(PDO::FETCH_ASSOC);
        return $timeSettings;
    }

    /**
     * @param $id
     * @return bool
     * перед удалением проверяем на наличее забронированной встречи в БД
     */
    public function getTimeById($id)
    {
        $query = 'SELECT * FROM `time-res` WHERE `id` = :id';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $id]);
        $timeExist = $res->fetch(PDO::FETCH_ASSOC);
        return (bool)$timeExist;
    }

    /**
     * @param $id
     * @return bool
     * удаление брони
     */
    public function removedTime($id)
    {
        $query = 'DELETE FROM `time-res` WHERE `id` = :id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $id]);
        return (bool)$res->rowCount();
    }

    public function updateTimeSetting($timeData)
    {

        $query = 'UPDATE `time-res-settings` SET `day-1`= :day1,`day-2`= :day2,`day-3`= :day3,`day-4`= :day4,`day-5`= :day5,`day-6`= :day6,`day-7`= :day7,`step`= :step,`desabled-week-days`= :desabledWeekDays,`disabled-dates`= :disabledDates,`min-time`= :minTime,`max-time`= :maxTime,`lunch-start`= :lunchStart,`lunch-finish`= :lunchFinish';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':day1' => $timeData['day-1'], ':day2' => $timeData['day-2'], ':day3' => $timeData['day-3'], ':day4' => $timeData['day-4'], ':day5' => $timeData['day-5'], ':day6' => $timeData['day-6'], ':day7' => $timeData['day-7'], ':step' => $timeData['step'], ':desabledWeekDays' => $timeData['desabled-week-days'], ':disabledDates' => $timeData['disabled-dates'], ':minTime' => $timeData['min-time'], ':maxTime' => $timeData['max-time'], ':lunchStart' => $timeData['lunch-start'], ':lunchFinish' => $timeData['lunch-finish']]);
        return (bool)$res->rowCount();

    }
}