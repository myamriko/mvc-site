<?php


class LinkadmModel
{
    use ResponseTrait;
    const CECHE_KEY = 'menu-site';
    public $id;
    public $menu_name;
    public $title;
    public $description;
    public $url;
    public $enabled;
    public $column;
    public $text;

    public function add()
    {
        $query = 'INSERT INTO `menu`(`menu_name`, `title`, `description`, `url`, `enabled`) VALUES (:menu_name, :title, :description, :url, :enabled)';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':menu_name' => $this->menu_name, ':title' => $this->title, ':description' => $this->description, ':url' => $this->url, ':enabled' => $this->enabled]);
        Cache::forget(self::CECHE_KEY . '-' . $this->menu_name);//очистить кеш
        return $dbh->lastInsertId();
    }

    public function update()
    {
        $query = 'UPDATE `menu` SET `' . $this->column . '`=:text WHERE `id` = :id LIMIT 1';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id, ':text' => $this->text]);
        Cache::forget(self::CECHE_KEY . '-' . $this->menu_name);//очистить кеш
        return (bool)$res->rowCount();
    }

    public function removed()
    {
        $query = "DELETE FROM `menu` WHERE `id`= :id LIMIT 1";
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        Cache::forget(self::CECHE_KEY . '-' . $this->menu_name);//очистить кеш
        return (bool)$res->rowCount();

    }

    public function getLink()
    {
        $query = 'SELECT * FROM `menu` WHERE `id`=:id';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([':id' => $this->id]);
        $link = $res->fetchAll(PDO::FETCH_ASSOC);
        return $link;
    }

    /**
     * @param $menuName
     * @return bool
     * Удаляем все линки меню при удалении меню.
     */
    public function removedAllLink($menuName)
    {
        $query = 'DELETE FROM `menu` WHERE  `menu_name` LIKE ?';
        $dbh = DB::getInstance();
        $res = $dbh->prepare($query);
        $res->execute([$menuName]);
        Cache::forget(self::CECHE_KEY . '-' . $menuName);//очистить кеш
        return (bool)$res->rowCount();
    }


}