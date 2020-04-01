<?php


class InfoadmModel

{
    use ResponseTrait;
    public $column;
    public $text;
    const CECHE_KEY ='info-site';

    public function update()
    {
        $column=$this->column;
        if ($column){
            $query = 'UPDATE `info-site` SET `'.$column.'`=:text LIMIT 1';
            $dbh= DB::getInstance();
            $res = $dbh->prepare($query);
            $res->execute([':text'=>$this->text]);
            Cache::forget(self::CECHE_KEY);//очистить кеш
            return (bool)$res->rowCount();
        }
        $this->getResponse(['success'=>false,'err'=>'Не указан столбец BD']);
    }

}