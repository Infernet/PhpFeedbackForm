<?php

namespace Infernet\Mailer;

require_once __DIR__."../../interfaces/IMailConverter.php";
require_once __DIR__."../../mail/FormData.php";

use Infernet\Interfaces\IMailConverter;
use Infernet\Database\FormData;

class MailBody
{
    public $subject="";
    public $attachment=null;
    public $body;
    public $isHtml;
    private $htmlPath=null;
    private $dataObject;
    
    public function __construct(FormData $dataObject, $subject, array $attachmentPaths=null, string $htmlPath=null)
    {
        $this->dataObject=$dataObject;
        $this->subject=$subject;
        if ($attachmentPaths!==null) {
            $this->attachment=$attachmentPaths;
        }
        if ($htmlPath!==null) {
            $this->htmlPath=$htmlPath;
            $this->isHtml=true;
            $this->htmlConvert();
        } else {
            $this->noHtmlConvert();
        }
    }

    private function htmlConvert()
    {
        $this->body=file_get_contents($this->htmlPath);
        $dataReplaceContent=$this->dataObject->getDataArray();
        $dataReplaceNames=$this->dataObject->getReplaceNames();
        foreach ($dataReplaceNames as $key => $value) {
            str_replace("(%$value%)", $dataReplaceContent[$key], $this->body);
        }
    }

    private function noHtmlConvert()
    {
        $this->body="";
        $content=$this->dataObject->getDataArray();
        foreach ($content as $value) {
            $this->body.="$value\n";
        }
    }
}
