<?php

namespace Infernet\Mailer;

use PHPMailer\PHPMailer\PHPMailer;
use Infernet\Config;

require_once __DIR__."../../../../vendor/autoload.php";
require __DIR__."../../../../vendor/phpmailer/phpmailer/src/SMTP.php";
require_once __DIR__."/MailBody.php";
require_once __DIR__."../../Config.php";

class Mailer
{
    private $mailer;

    public function __construct()
    {
        $this->mailer=new PHPMailer();
    }

    public function sendMessage(MailBody $messageBody)
    {
        $this->setSettingMailer($messageBody->isHtml);
        $this->mailer->Subject=$messageBody->subject;
        $this->mailer->Body=$messageBody->body;
        if ($messageBody->attachment!==null) {
            foreach ($messageBody->attachment as $value) {
                $fileName=pathinfo($value)["filename"];
                $this->mailer->addAttachment($value, $fileName);
            }
        }
        if ($this->mailer->send()) {
            return true;
        } else {
            return false;
        }
    }

    private function setSettingMailer($isHTML)
    {
        $this->mailer->isSMTP();
        $this->mailer->Host=Config::getInstance()::MAILER_HOST;
        $this->mailer->SMTPAuth=true;
        $this->mailer->Username=Config::getInstance()::MAILER_LOGIN;
        $this->mailer->Password=Config::getInstance()::MAILER_PASSWORD;
        $this->mailer->SMTPSecure=Config::getInstance()::MAILER_SMTP_SECURE;
        $this->mailer->Port=Config::getInstance()::MAILER_PORT;
        $this->mailer->CharSet=Config::getInstance()::MAILER_CHAR_SET;
        $this->mailer->setFrom(Config::getInstance()::MAILER_EMAIL_FROM, Config::getInstance()::MAILER_EMAIL_NAME);
        $this->mailer->addAddress(Config::getInstance()::MAILER_SEND_TO_EMAIL);
        $this->mailer->isHTML($isHTML);
    }
}
