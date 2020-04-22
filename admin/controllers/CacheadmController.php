<?php


class CacheadmController
{
    use ResponseTrait;
    const  CACHE_SRMATY = '../public/storage/templates_c/';
    const  CACHE_DATA = '../public/storage/cache_data/';

    /**
     * В SMARTY изменил путь кеша на ./public/storage/templates_c/
     */
    public function removeAll($cache=null,$type=null)// при изменении пагинации приходит $cache и $type
    {
        if ($_POST['cache'] || $cache) {
            switch (true) {
                case $_POST['type'] === 'smarty':
                    $cache_dir = self::CACHE_SRMATY;
                    $info =' Кеш шаблона очищен';
                    break;
                case $_POST['type'] === 'data' || $type === 'data' :
                    $cache_dir = self::CACHE_DATA;
                    $info = 'Кеш данных очищен';
                    break;
            }
            $cache = scandir($cache_dir);//счытываем файлы в директории
            foreach ($cache as $item => $value) {
                if ($value != '.' && $value != '..') {
                    $fileDir = $cache_dir . $value;
                    if (file_exists($fileDir)) {
                        unlink($fileDir);
                    }
                }
            }

            $this->getResponse(['success' => true, 'err' => $info]);
        }
    }

}