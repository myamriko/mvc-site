<?php

use \interfaces\ControllerInterface as Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactadmController implements Controller
{

    use errTrait;
    use ResponseTrait;
    use ExtraTrait;


    public function index()
    {
        global $smarty;
        $siteData = InfoModel::info();
        $report = new ContactsModel();
        $report = $report->allErr();
        $reports = $this->report($report);
        $smarty->assign('siteData', $siteData);
        $smarty->assign('reports', $reports);
        $smarty->display('admin/contactReport.tpl');

    }

    public function send()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $reports = new ContactadmModel();
            $reportId = $reports->report($id);
            if (!$reportId) {
                $this->getResponse(['success' => false, 'err' => 'письмо с таким ID не существует, очистьте кеш и 
                повторите попытку, если ошибка повторится обратитесь с администратору']);
            }
            $reportId = $this->report($reportId);
            $this->getResponse([
                'success' => true,
                'id' => $reportId[0]['id'],
                'date' => $reportId[0]['date'],
                'name' => $reportId[0]['name'],
                'mailTo' => $reportId[0]['mailTo'],
                'phone' => $reportId[0]['phone'],
                'subject' => $reportId[0]['subject'],
                'message' => $reportId[0]['message']
            ]);
        }
        $this->getResponse(['success' => false, 'err' => 'Пустой ПОСТ запрос']);

    }

    public function reply()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $mailTo = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
        $copyCC = filter_var(trim($_POST['copyCC']), FILTER_SANITIZE_STRING);
        $copyBCC = filter_var(trim($_POST['copyBCC']), FILTER_SANITIZE_STRING);
        $date = date('y-m-d');
        $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
        $reMessage = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
        $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

        $err = $this->getErrMail($name, $mailTo, $phone, $subject, $reMessage);
        if (!empty($err)) {
            $this->getResponse(['success' => false, 'err' => $err]);
        }

        $messageHtml = $reMessage .
            '<p>' . $date . '</p><hr>' .
            '<h4>Исходное сообщение:</h4>' .
            '<p>Имя: ' . $name . '<br>
            Телефон: ' . $phone . '<br>'
            . $message . '<br>'
            . $date . '</p>';
        $siteData = InfoModel::info();
        $encrypts = new Encrypt();//декриптор пароля
        $pass = $encrypts->dsCrypt($siteData['pss_admin'], $decrypt = true);

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
            $mail->addAddress($mailTo);
            $mail->addCC($copyCC);
            $mail->addBCC($copyBCC);
            $mail->addReplyTo($siteData['sitemail'], $siteData['sitename']);
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $messageHtml;
            $mail->AltBody = $reMessage;
            $mail->send();
            $reSend = new ContactadmModel();
            $reSend->update($id);
            $this->getResponse(['success' => true, 'err' => 'Сообщение успешно отправленно']);
        } catch (Exception $e) {
            $this->getResponse(['success' => false, 'err' => 'Не удалось отправить сообщение свяжитесь с администратором сайта.<br><strong>Mailer Error: </strong>' . $mail->ErrorInfo]);
        }
    }

    public function removed()
    {
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
        if (!empty($id)) {
            $exist = new  ContactadmModel();
            $exist = $exist->report($id);
            if (!$exist) {
                $this->getResponse(['success' => false, 'err' => 'Похоже кто-то уже избавился от этой ошибки, пожалуйста очистьте кеш, обновите страницу и 
            повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта']);
            }
            $message = new ContactadmModel();
            $message = $message->removed($id);
            $this->getResponse(['success' => $message, 'err' => 'Не удалось удалить сообщение, пожалуйста очистьте кеш, обновите 
            страничку и повторите попытку, если ошибка не исчезнет обратитесь к администратору сайта.']);
        }
        $this->getResponse(['success' => false, 'err' => 'Пустой ПОСТ запрос']);

    }
}