<?php


trait ArticleTrait
{
    public function setData()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
        $intro = filter_var(trim($_POST['intro']), FILTER_SANITIZE_STRING);
        $text = $_POST['text'];
        $url = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
        $translite = new Translite();
        $url = $translite->cyrillic($url);
        $category = filter_var(trim($_POST['category']), FILTER_SANITIZE_STRING);
        $author = filter_var(trim($_POST['author']), FILTER_SANITIZE_STRING);
        $oldFile = filter_var(trim($_POST['oldFile']), FILTER_SANITIZE_STRING);
        $alt = filter_var(trim($_POST['alt']), FILTER_SANITIZE_STRING);
        $published = filter_var(trim($_POST['published']), FILTER_SANITIZE_STRING);
        $front = filter_var(trim($_POST['front']), FILTER_SANITIZE_STRING);
        $tags = filter_var(trim($_POST['tags']), FILTER_SANITIZE_STRING);
        $tags = mb_strtolower($tags);//все в нижнем регистре
        $symbol = ['\\', '.', '/', ';', ':', '[', ']', '{', '}'];
        $tags = trim(str_replace($symbol, '', $tags), ',');
        $data = [
            'id' => $id,
            'title' => $title,
            'intro' => $intro,
            'text' => $text,
            'tags' => $tags,
            'url' => $url,
            'category' => $category,
            'author' => $author,
            'oldFile' => $oldFile,
            'alt' => $alt,
            'published' => $published,
            'front' => $front
        ];

        $err = $this->getErrArticle($data);//проверка всего

        if ($err) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }

        if (!$_FILES && empty($oldFile)) {
            $this->getResponse(['success' => false, 'err' => ' Вы не выблали изображение']);
        }
        if ($_FILES){
            $err = $this->getErrImg();//проверка картинки
            if ($err) {
                $this->getResponse(['success' => false, 'err' => $err]);
            }
        }
        if (!empty($tags)) {
            $tagArr = explode(',', $tags);
            $tagsExist = new TagsadmModel();
            foreach ($tagArr as $value) {
                if ($value != '') {
                    $tagsExist->tag = $value;
                    $tag = $tagsExist->getTag();
                    if (!$tag) {
                        $tagsExist->url = $translite->cyrillic($value);
                        $tagsExist->add();
                    }
                }
            }
        }
        return $data;
    }
}