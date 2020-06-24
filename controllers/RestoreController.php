<?php

use \interfaces\ControllerInterface as Controller;

class RestoreController implements Controller
{
    use ViewsTrait;
    use ResponseTrait;
    use ExtraTrait;

    public function index()
    {
        global $smarty;
        $this->menuPrincipal();
        $smarty->display('public/restore.tpl');
    }

    public function restorePass()
    {
        $pass = new Salt();
        $pass = $pass->restorePassRnd();

        $restoreEmail = filter_var(trim($_POST['restoreEmail']), FILTER_SANITIZE_EMAIL);
        if (!empty($restoreEmail)) {
            $restore = new UserModel();
            $user = $restore->getUserByLogin($login = null, $id = null, $restoreEmail);
            $editPass = new AccountController();

            $editPass = $editPass->makePass($user['login'], 'Resto_te-PaSS88', $pass, $pass);
            if (!$editPass) {
                $this->getResponse(['success' => false, 'err' => ' Не вдалося внести зміни dв БД.']);
            }
            unset($user['pass']);
            unset($user['salt']);
            if (!$user) {
                $this->getResponse(['success' => false, 'err' => 'Така адреса електронної пошти не зареєстрована.']);
            }
            $Return = $this->captcha();//ExtraTrait
            if ($Return->success != true || $Return->score < 0.5) {
                $this->getResponse(['success' => false, 'err' => ' Ви робот? <br> Якщо ні, поновіть сторінку і спробуйте ще раз']);
            }
            /*Отправка на почту*/
            $siteData = InfoModel::info();
            $encrypts = new Encrypt();//декриптор пароля
            $passEmail = $encrypts->dsCrypt($siteData['pss_admin'], $decrypt = true);

            $message = 'Тимчасовий пароль: ' . $pass;
            $date = date("Y-m-d H:i:s");
            $subject = 'Відновлення паролю - ' . $siteData['sitename'];
            $messageHtml = '<h2>Вітаю ' . $user['username'] . '</h2>
                    <h3>Відновлення паролю</h3>
                    <p>Тимчасовий пароль: ' . $pass . '</p>
                    <p>Після аутентифікації змініть пароль в особистому кабінеті</p>
                    <p>З повагою, адміністрація сайту ' . $siteData['sitename'] . '<br>' . $date . '</p>';
            $mailerData = [
                'host' => $siteData['smtp_host'],
                'username' => $siteData['adminmail'],
                'port' => $siteData['mail_port'],
                'fromEmail' => $siteData['adminmail'],
                'fromName' => $siteData['sitename'],
                'address' => $user['email'],
                'passEmail' => $passEmail,
                'name' => '<no reply>'.$siteData['sitename'],
                'mailTo' => $user['email'],
                'phone' => '',
                'message' => $message,
                'subject' => $subject,
                'messageHtml' => $messageHtml
            ];

            $mailer = new Mailer();
            $mailer->mailerSend($mailerData);
        }
        $this->getResponse(['success' => false, 'err' => 'Прийшов порожній запит, будь ласка очистіть кеш і
        поновіть сторінку. Якщо помилка зявиться знов зв\'яжіться з адміністратором сайту.']);
    }
}