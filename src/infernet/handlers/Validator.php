<?php
namespace Infernet\Handler;

class Validator
{
    /**
     * Проверяет валидный ли E-mail, если да, то
     * возвращает TRUE.
     * @param string $email
     * @return boolean
     */
    public static function checkEmail($email)
    {
        $emailLength=strlen($email);
        return $emailLength>0 && $emailLength<=100 && filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    /**
     * Проверяет правильность имени (состоит из букв и длиной не более 100 символов),
     * если да, то возвращает TRUE
     * @param string $name
     * @return boolean
     */
    public static function checkName($name)
    {
        $regExp="/^[а-яё]{1,100}|[a-z]{1,100}$/i";
        $nameLength=strlen($name);
        return $nameLength>0 && $nameLength<=100 && preg_match($regExp, $name);
    }
    /**
     * Проверяет наличие буквенной или цифровой информации
     * в сообщении, а так же его длину. Возвращает TRUE в случае
     * наличия букв или цифр
     * @param string $message
     * @return boolean
     */
    public static function checkMessage($message)
    {
        $messageLength=strlen($message);
        $regExp="/[a-zа-яё\d]*/i";
        return $messageLength>0 && $messageLength<=1000 && preg_match($regExp, $message);
    }

    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}
