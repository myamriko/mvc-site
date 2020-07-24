<?php


class Telegram
{
    public static function sender ($txt){
        $siteData = InfoModel::info();
        fopen("https://api.telegram.org/bot{$siteData['token']}/sendMessage?chat_id={$siteData['id_chat']}&parse_mode=html&text={$txt}","r");
        return null;
    }

}