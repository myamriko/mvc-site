<?php


class CommentsController
{

    use ResponseTrait;
    use ExtraTrait;

    public function send()
    {
        if ($_POST['userName'] || $_POST['text']) {
            $userName = filter_var(trim($_POST['userName']), FILTER_SANITIZE_STRING);
            $userId = filter_var(trim($_POST['userId']), FILTER_SANITIZE_STRING);
            $userId = !$userId ? "0" : $userId;
            $article_id_comment = filter_var(trim($_POST['article_id_comment']), FILTER_SANITIZE_STRING);
            $article_title_comment = filter_var(trim($_POST['article_title_comment']), FILTER_SANITIZE_STRING);
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            $parentId = filter_var(trim($_POST['parentId']), FILTER_SANITIZE_STRING);
            if ($userId !== "0") {
                $userModel = new UserModel();
                $user = $userModel->getUserByLogin(null, $userId, null);
            }
            $Return = $this->captcha();//ExtraTrait
            if ($Return->success == true && $Return->score > 0.5) {//проверка капчи
                $commentSend = new CommentsModel();
                $comment = $commentSend->send($userName, $userId, $text, $article_id_comment, $parentId);
                if (!$comment) {
                    $this->getResponse(['success' => false, 'err' => 'Не вдалося внести зміни в БД, поновіть сторінку і спробуйте ще раз. Якщо помилка повториться, зверніться до адміністратора сайту.']);
                }

                Telegram::sender("Користувач: " . $userName . "%0AДодав коментар: " . $text . "%0AДо статті: " . $article_title_comment);

                $this->getResponse(['success' => $comment, 'text' => $text, 'avatar' => $user['avatar'], 'username' => $userName, 'date' => date("Y-m-d H:i")]);
            }
            $this->getResponse(['success' => false, 'err' => 'Ви робот? <br> Якщо ні, поновіть сторінку і спробуйте ще раз.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Прийшов порожній POST запит, поновіть сторінку і спробуйте ще раз. Якщо помилка не зникне зверніться до адміністратару сайту.']);
    }

    public function removed()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        $article_title_comment = filter_var(trim($_POST['article_title']), FILTER_SANITIZE_STRING);

        $commentsModel = new CommentsModel();
        $commentExist = $commentsModel->getCommentById($id);

        if (!$commentExist) {
            $this->getResponse(['success' => false, 'err' => 'Такого коментаря не існує, будь ласка поновіть сторінку і спробуйте ще раз. Якщо помилка не зникне зверніться до адміністратару сайту.']);
        }
        $parentIdExist = $commentsModel->getCommentByParentId($id);
        if (!empty($parentIdExist)) {
            $this->getResponse(['success' => false, 'err' => 'Коментар містить відповіді.<br>Спочатку видаліть відповіді.']);
        }

        $commentRemove = $commentsModel->remove($id);
        if ($commentRemove){
            Telegram::sender("Користувач: " . $commentExist['username'] . "%0AВидалив коментар: " . $commentExist['mess'] . "%0AДо статті: " . $article_title_comment);
        }
        $this->getResponse(['success' => $commentRemove]);
    }

    public function edit(){
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
        $article_title_comment = filter_var(trim($_POST['article_title_comment']), FILTER_SANITIZE_STRING);

        $commentsModel = new CommentsModel();
        $commentExist = $commentsModel->getCommentById($id);
        if (!$commentExist) {
            $this->getResponse(['success' => false, 'err' => 'Такого коментаря не існує, будь ласка поновіть сторінку і спробуйте ще раз. Якщо помилка не зникне зверніться до адміністратару сайту.']);
        }

        $Return = $this->captcha();//ExtraTrait
        if ($Return->success == true && $Return->score > 0.5) {//проверка капчи
        $commentEdit = $commentsModel->edit($id, $text);
            if (!$commentEdit) {
                $this->getResponse(['success' => false, 'err' => 'Не вдалося внести зміни в БД, поновіть сторінку і спробуйте ще раз. Якщо помилка повториться, зверніться до адміністратора сайту.']);
            }

            Telegram::sender("Користувач: " . $commentExist['username'] . "%0AЗмінив коментар: " . $text . "%0AДо статті: " . $article_title_comment);

            $this->getResponse(['success' => $commentEdit, 'date' => date("Y-m-d H:i")]);
        }

        $this->getResponse(['success' => false, 'err' => 'Ви робот? <br> Якщо ні, поновіть сторінку і спробуйте ще раз.']);

    }

}