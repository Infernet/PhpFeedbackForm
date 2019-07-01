<?php
namespace Infernet\Database;

require_once __DIR__."../../interfaces/IMailConverter.php";

use Infernet\Interfaces\IMailConverter;

class FormData implements IMailConverter
{
    public $name="";
    public $email="";
    public $message="";

    public function __construct(string $name, string $email, string $message)
    {
        $this->name=$name;
        $this->email=$email;
        $this->message=$message;
    }
    

    public function getDataArray()
    {
        return array(
            $this->name,
            $this->email,
            $this->message
        );
    }

    public function getReplaceNames()
    {
        return array(
            "NAME",
            "EMAIL",
            "MESSAGE"
        );
    }
}
