<?php

use \interfaces\ControllerInterface as Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactsController implements Controller
{
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
        $pass = $encrypts->dsCrypt($siteData['pss_admin'], $decrypt = true);
        /*recaptcha3 @ отключаем вывод ошибки SSL сертификата*/
        //в хедере и футере скрипт, в форме скрытая строка, через jquery передаем с остальными данными $_POST['g_recaptcha_response']
        $Response = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$siteData['sekretkey']."&response={$_POST['g_recaptcha_response']}");
        $Return = json_decode($Response);
        if ($Return->success == true && $Return->score > 0.5) {//проверка капчи

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = $siteData['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $siteData['adminmail'];
            $mail->Password = $pass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $siteData['mail_port'];
            $mail->CharSet = "utf-8";

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Recipients
            $mail->setFrom($siteData['adminmail'], $siteData['sitename']);
            $mail->addAddress($siteData['sitemail']);
            $mail->addReplyTo($mailTo, $name);
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $messageHtml;
            $mail->AltBody = $message;
            $mail->send();
            $this->getResponse(['success' => true, 'err' => 'Сообщение успешно отправленно']);
        } catch (Exception $e) {
            $result = [];
            $result['name'] = $name;
            $result['mailTo'] = $mailTo;
            $result['phone'] = $phone;
            $result['subject'] = $subject;
            $result['message'] = $message;
            $messageJson = json_encode($result);
            $addErr = new ContactsModel();
            $addErr = $addErr->addErr($mail->ErrorInfo, $messageJson);
            if (!$addErr) {
                $this->getResponse(['success' => false, 'err' => 'Не удалось внести изменения в БД.<br><strong>Mailer Error: </strong>' . $mail->ErrorInfo]);
            }
            $this->getResponse(['success' => false, 'err' => 'Не удалось отправить сообщение. Сообщение было сохранено, с вами свяжется наш представитель.<br><strong>Mailer Error: </strong>' . $mail->ErrorInfo]);
        }
        }
            $this->getResponse(['success' => false, 'err' => 'Вы робот?<br> Если нет, обновите страничку и повторите попытку.']);

    }
}