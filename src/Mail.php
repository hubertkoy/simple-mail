<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    /**
     * @var PHPMailer
     */
    private $mail;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = MAIL_HOST;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = MAIL_USER;
        $this->mail->Password = MAIL_PASS;
        $this->mail->SMTPSecure = MAIL_ENCRYPTION;
        $this->mail->Port = MAIL_PORT;
        $this->mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);

    }

    public function send($subject, $body, $replyTo = null, $replyToName = null)
    {
        try {
            if ($replyTo) {
                $this->mail->addReplyTo($replyTo, $replyToName ?? $replyTo);
            }
            $this->mail->addAddress(MAIL_FROM, MAIL_FROM_NAME);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
        } catch (Exception $e) {
            echo 'Wiadomość nie mogła zostać wysłana. Mailer Error: ', $e->getMessage();
        }
    }
}
