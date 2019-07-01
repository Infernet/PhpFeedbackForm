<?php

namespace Infernet;

use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

class FormResult implements JsonSerializable
{
    public $nameValidStatus=false;
    public $emailValidStatus=false;
    public $messageValidStatus=false;
    public $insertToDbStatus=false;
    public $isDuplicateRecord=false;
    public $sendToEmailStatus=false;
    public function isValidData()
    {
        if ($this->nameValidStatus && $this->emailValidStatus && $this->messageValidStatus) {
            return true;
        } else {
            return false;
        }
    }

    public function jsonSerialize()
    {
        $reflect=new ReflectionClass($this);
        $props=$reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $result=array();
        foreach ($props as $item) {
            $name=$item->getName();
            $result[$name]=$this->$name;
        }
        return $result;
    }

    public function __toString()
    {
        return json_encode($this->jsonSerialize(), JSON_UNESCAPED_UNICODE);
    }
}
