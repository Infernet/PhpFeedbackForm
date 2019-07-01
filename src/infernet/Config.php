<?php

namespace Infernet;

class Config
{
    public const DB_HOST="localhost";
    public const DB_DATABASE_NAME="feedbackdb";
    public const DB_USER_NAME="root";
    public const DB_PASSWORD="";

    public const MAILER_HOST="smtp.yandex.ru";
    public const MAILER_SMTP_SECURE="ssl";
    public const MAILER_PORT="465";
    public const MAILER_CHAR_SET="UTF-8";
    public const MAILER_LOGIN="/*Введите ваш логин*/";
    public const MAILER_PASSWORD="/*Введите ваш пароль*/";
    public const MAILER_EMAIL_FROM="/*Email с которого отправляется письмо*/";
    public const MAILER_EMAIL_NAME="Локальный сервер";
    public const MAILER_SEND_TO_EMAIL="/*Адрес доставки*/";

    protected static $instance=null;
    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance=new self;
        }
        return self::$instance;
    }
}
