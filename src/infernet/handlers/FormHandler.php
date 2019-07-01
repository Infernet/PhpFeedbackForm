<?php

namespace Infernet\Handler;

require_once __DIR__."/Validator.php";
require_once __DIR__."../../Config.php";
require_once __DIR__."../../FormResult.php";
require_once __DIR__."../../database/FeedbackDb.php";
require_once __DIR__."../../mail/MailBody.php";
require_once __DIR__."../../mail/Mailer.php";
require_once __DIR__."../../mail/FormData.php";

use Infernet\FormResult;
use Infernet\Database\FeedbackDb;
use Infernet\Config;
use Infernet\Mailer\MailBody;
use Infernet\Database\FormData;
use Infernet\Mailer\Mailer;

class FormHandler
{
    private $progressResult;
    private $mailBody;

    public function __construct()
    {
        $this->progressResult=new FormResult();
    }
    
    public function sendData($name, $email, $message)
    {
        $this->progressResult->nameValidStatus=Validator::checkName($name);
        $this->progressResult->emailValidStatus=Validator::checkEmail($email);
        $this->progressResult->messageValidStatus=Validator::checkMessage($message);
        if (!$this->progressResult->isValidData()) {
            return $this->progressResult->__toString();
        } else {
            $dbObject=new FeedbackDb(Config::DB_HOST, Config::DB_USER_NAME, Config::DB_PASSWORD);
            $insertResult=$dbObject->insertFormData($name, $email, $message);
            switch ($insertResult) {
                case '-1':
                    $this->progressResult->isDuplicateRecord=true;
                    return $this->progressResult->__toString();
                    break;
                case '0':
                    return $this->progressResult->__toString();
                    break;
                default:
                    $this->progressResult->insertToDbStatus=true;
                    break;
            }
            $formData=new FormData($name, $email, $message);
            $this->mailBody=new MailBody($formData, "Оповещение о новой записи в базе данных", null, null);
            $mailer=new Mailer();
            $this->progressResult->sendToEmailStatus=$mailer->sendMessage($this->mailBody);
            return $this->progressResult->__toString();
        }
    }
}
