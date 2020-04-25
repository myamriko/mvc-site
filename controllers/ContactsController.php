<?php

use \interfaces\ControllerInterface as Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactsController implements Controller
{
    use ViewsTrait;
    use ResponseTrait;



    public function index()
    {
        global $smarty;
        $this->menuPrincipal();
        $smarty->display('public/contact.tpl');
    }

    public function send()
    {
        /**
         * сначала в гугле почтовом ящике необходимо разрешить доступ Небезопасным приложениям к связанному аккаунту.
         */
        $siteData = InfoModel::info();
        $encrypts = new Encrypt();//декриптор пароля
        $pass=$encrypts->dsCrypt($siteData['pss_admin'], $decrypt=true);
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = $siteData['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $siteData['adminmail'];
            $mail->Password = $pass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $siteData['mail_port'];
            // вот это не указано в описании но без него не работает
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );


            $mail->setFrom($siteData['sitemail'], $siteData['sender']); // от кого
            //Recipients
            //  $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $mail->addAddress('fontaneria1@gmail.com', 'jon Doo');               // кому, мыло сайта
            $mail->addReplyTo($siteData['sitemail'], $siteData['sender']); // ответ кому
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
           // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $this->getResponse(['success'=>' Сообщение успешно отправлено!']);

        } catch (Exception $e) {
            $this->getResponse(['success'=>false, 'err'=>" Не удалось отправить сообшение. Mailer->Error: {$mail->ErrorInfo}"]);
        }
    }
}