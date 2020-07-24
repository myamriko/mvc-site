<?php


class TimeresModel
{

    /**
     * @param $monthYear
     * @return array
     * выбираем из базы занятое время за этот месяц
     */
    public function busyTime($monthYear)
    {
        $query = 'SELECT `day`,`time` FROM `time-res` WHERE `month-year` LIKE ? ORDER BY `time` ASC ';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([$monthYear]);
        $timeReses = $res->fetchAll(PDO::FETCH_ASSOC);
        return $timeReses;
    }

    public function bookingTime($allDateArr, $name, $phone)
    {

        $query = 'INSERT INTO `time-res`(`day`, `month-year`, `time`, `name`, `tel`) VALUES ( :days, :monthYear, :times, :nameCustomer,:phone)';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':days' => $allDateArr[0], ':monthYear' => $allDateArr[1], ':times' => $allDateArr[2], ':nameCustomer' => $name, ':phone'=> $phone]);
        return (bool)$res->rowCount();

    }

}