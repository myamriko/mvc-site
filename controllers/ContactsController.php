<?php

use \interfaces\ControllerInterface as Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactsController implements Controller
{

    private $name;
    private $mailTo;
    private $phone;
    private $date;
    private $subject;
    private $message;


    use ViewsTrait;
    use ResponseTrait;
    use errTrait;
    use ExtraTrait;

    public function index()
    {
        global $smarty;
        $this->menuPrincipal();//главное меню во вьевс трейте
        $smarty->display('public/contact.tpl');
    }

    public function send_mail()
    {
        /**
         * сначала в гугле почтовом ящике необходимо разрешить доступ Небезопасным приложениям к связанному аккаунту.
         */

        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $mailTo = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
        $date = filter_var(trim($_POST['date']), FILTER_SANITIZE_STRING);
        $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
        $message = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);

        $err = $this->getErrMail($name, $mailTo, $phone, $subject, $message);
        if (!empty($err)) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }
        $messageHtml = '<h3>Контактные данные:</h3>
                    <p>Имя: ' . $name . '<br>
                    E-mail: ' . $mailTo . '<br>
                    Телефон: ' . $phone . '<br>
                    ' . $date . '</p>
                    <hr><p>' . $message . '</p>';
        $siteData = InfoModel::info();
        $encrypts = new Encrypt();//декриптор пароля
        $passEmail = $encrypts->dsCrypt($siteData['pss_admin'], $decrypt = true);

        $Return = $this->captcha();//ExtraTrait
        if ($Return->success == true && $Return->score > 0.5) {//проверка капчи
            $mailerData = [
                'host' => $siteData['smtp_host'],
                'username' => $siteData['adminmail'],
                'port' => $siteData['mail_port'],
                'fromEmail' => $siteData['adminmail'],
                'fromName' => $siteData['sitename'],
                'address' => $siteData['sitemail'],
                'passEmail' => $passEmail,
                'name' => $name,
                'mailTo' => $mailTo,
                'phone' => $phone,
                'message' => $message,
                'subject' => $subject,
                'messageHtml' => $messageHtml
            ];

            $mailer = new Mailer();
            $mailer->mailerSend($mailerData);
        }
        $this->getResponse(['success' => false, 'err' => 'Ви робот? <br> Якщо ні, поновіть сторінку і спробуйте ще раз.']);

    }
}