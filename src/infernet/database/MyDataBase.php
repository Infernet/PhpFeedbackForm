<?php
namespace Infernet\Database;

use mysqli;

/**
 * MyDataBase: базовый класс для работы с базой данных
 */
class MyDataBase
{
    protected $dbhost="";
    protected $database="";
    protected $dblogin="";
    protected $dbpassword="";
    protected $link;

    public function __construct($host, $name, $login, $password)
    {
        $this->dbhost=$host;
        $this->database=$name;
        $this->dblogin=$login;
        $this->dbpassword=$password;
    }
    /**
     * Метод открывающий соединение с базой данных
     *
     */
    protected function connect()
    {
        $this->link=mysqli_connect($this->dbhost, $this->dblogin, $this->dbpassword, $this->database) or die("Ошибка " . mysqli_error($this->link));
        mysqli_query($this->link, 'SET NAMES utf8');
    }

    protected function close()
    {
        mysqli_close($this->link);
        unset($this->link);
    }
}
