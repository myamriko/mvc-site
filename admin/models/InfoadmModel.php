<?php


class InfoadmModel

{
    use ResponseTrait;
    public $column;
    public $text;
    public $cacheName;
    const CACHE_KEY ='info-site';

    public function update()
    {
        $column=$this->column;
        if ($column){
            $query = 'UPDATE `info-site` SET `'.$column.'`=:text LIMIT 1';
            $dbh= DB::getInstance();
            $res = $dbh->prepare($query);
            $res->execute([':text'=>$this->text]);
            Cache::forget(self::CACHE_KEY);
            Cache::forget($this->cacheName);
            return (bool)$res->rowCount();
        }
        $this->getResponse(['success'=>false,'err'=>'Не указан столбец BD']);
    }

}