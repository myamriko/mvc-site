<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    use ResponseTrait;

    public function mailerSend($mailerData)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = $mailerData['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $mailerData['username'];
            $mail->Password = $mailerData['passEmail'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $mailerData['port'];
            $mail->CharSet = "utf-8";

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Recipients
            $mail->setFrom($mailerData['fromEmail'], $mailerData['fromName']);
            $mail->addAddress($mailerData['address']);
            $mail->addReplyTo($mailerData['mailTo'], $mailerData['name']);
            // Content
            $mail->isHTML(true);
            $mail->Subject = $mailerData['subject'];
            $mail->Body = $mailerData['messageHtml'];
            $mail->AltBody = $mailerData['message'];
            $mail->send();
            $this->getResponse(['success' => true, 'err' => 'Повідомлення успішно надіслано']);
        } catch (Exception $e) {
            $result = [];
            $result['name'] = $mailerData['name'];
            $result['mailTo'] = $mailerData['mailTo'];
            $result['phone'] = $mailerData['phone'];
            $result['subject'] = $mailerData['subject'];
            $result['message'] = $mailerData['messageHtml'];
            $messageJson = json_encode($result);
            $addErr = new ContactsModel();
            $addErr = $addErr->addErr($mail->ErrorInfo, $messageJson);
            if (!$addErr) {
                $this->getResponse(['success' => false, 'err' => 'Не вдалося внести зміни в БД.<br><strong>Mailer Error: </strong>' . $mail->ErrorInfo]);
            }
            $this->getResponse(['success' => false, 'err' => 'Не вдалося надіслати повідомлення. Повідомлення було збережено, з вами зв\'яжеться наш представник.<br><strong>Mailer Error: </strong>' . $mail->ErrorInfo]);
        }

    }

}