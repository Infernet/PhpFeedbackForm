<?php

require_once  __DIR__."/infernet/handlers/Validator.php";
require_once __DIR__."/infernet/database/FeedbackDb.php";
require_once __DIR__."/infernet/database/MyDataBase.php";

use Handler\Validator;
use Infernet\Database\FeedbackDb;

if (!Validator::isAjax() || !Validator::isPost()) {
    echo 'Доступ запрещен!';
    exit;
}

$name = isset($_POST['userName']) ? trim(strip_tags($_POST['userName'])) : null;
$email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : null;
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : null;

$errorFlag=false;
$validData=array(
    "name"=>false,
    "email"=>false,
    "message"=>false
);
$result=array(
    'successful'=>false,
    'nameValid'=>false,
    'emailValid'=>false,
    'messageValid'=>false,
    'duplicateRecord'=>false
);


foreach ($validData as $key=>&$val) {
    if (empty(${$key})) {
        $errorFlag=true;
        $val='true';
    }
}

if ($errorFlag) {
    //Не все поля заполнены
    $validData['successful']=false;
    $validData['duplicateRecord']=false;
    $json=json_encode($validData);
    echo $json;
    return;
} else {
    $validData['name']=!Validator::checkName($name);
    $validData['email']=!Validator::checkEmail($email);
    $validData['message']=!Validator::checkMessage($message);
 
    foreach ($validData as $val) {
        if ($val) {
            $errorFlag=true;
            break;
        }
    }
    if ($errorFlag) {
        //Поля не прошли валидацию
        $validData['successful']=false;
        $validData['duplicateRecord']=false;
        $json=json_encode($validData);
        echo $json;
        return;
    } else {
        //Формирование запроса в базу данных на добавление
        $feedbackDbObject=new FeedbackDb("localhost", "root", "");
        $feedbackId=$feedbackDbObject->insertFormData($name, $email, $message);
        if ($feedbackId=="0") {
            //Форма с такими данными уже находится в базе
            $validData['successful']=false;
            $validData['duplicateRecord']=true;
            $json=json_encode($validData);
            return;
        } else {
            //Успешное добавление
            $validData['successful']=true;
            $validData['duplicateRecord']=false;
            $json=json_encode($validData);
            echo $json;
            exit;
        }
    }
}
