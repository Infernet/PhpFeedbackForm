<?php
namespace Infernet\Database;

class FormData
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
}
