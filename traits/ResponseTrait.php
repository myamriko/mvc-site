<?php


trait ResponseTrait
{
    public function getResponse($data = ['success' => true])//что бы не проставлять везде заголовок и не копировать json_encode создадим частную ф-цию
    {
        header('Content-Type: application/json');
        die(json_encode([$data]));
    }

}