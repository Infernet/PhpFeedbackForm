<?php
use Infernet\Handler\Validator;
use Infernet\Handler\FormHandler;

require_once __DIR__."/infernet/handlers/Validator.php";
require_once __DIR__."/infernet/handlers/FormHandler.php";

if (!Validator::isAjax() || !Validator::isPost()) {
    echo 'Доступ запрещен!';
    exit;
}

$name = isset($_POST['userName']) ? trim(strip_tags($_POST['userName'])) : null;
$email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : null;
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : null;

$formHandler=new FormHandler();
echo $formHandler->sendData($name, $email, $message);
return;
