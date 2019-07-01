<?php
namespace Infernet\Database;

use Infernet\Config;

require_once "MyDataBase.php";
/**
 * FeedbackDb расширенный класс для работы с feedbackdb
 */
class FeedbackDb extends MyDataBase
{
    public function __construct($host, $login, $password)
    {
        parent::__construct($host, Config::DB_DATABASE_NAME, $login, $password);
    }

    public function insertFormData($name, $email, $message)
    {
        $this->connect();
        $idList=array('username'=>-1,'useremail'=>-1,'usermessage'=>-1,'feedback'=>0);

        $idList["username"]=$this->getPrimaryKeyRecord($name, "username", "nameId", "name");
        $idList["useremail"]=$this->getPrimaryKeyRecord($email, "useremail", "idEmail", "email");
        $idList["usermessage"]=$this->getPrimaryKeyRecord($message, "usermessage", "idMessage", "message");

        
        $checkId=true;
        foreach ($idList as $value) {
            if ($value==-1) {
                $checkId=false;
                break;
            }
        }

        if ($checkId) {
            $selectQuery="SELECT idFeedback from feedback WHERE fk_name_id= $idList[username] AND fk_email_id=$idList[useremail] AND fk_message_id=$idList[usermessage]";
            $insertQuery="INSERT INTO feedback ( fk_name_id , fk_email_id , fk_message_id ) VALUES ($idList[username],$idList[useremail],$idList[usermessage])";
            $resultQuery=mysqli_query($this->link, $selectQuery) or die("Ошибка " . mysqli_error($this->link));
            if (!mysqli_num_rows($resultQuery)) {
                mysqli_query($this->link, $insertQuery) or die("Ошибка " . mysqli_error($this->link));
                $idList['feedback']=mysqli_insert_id($this->link);
            } else {
                $idList['feedback']=-1;
            }
        }
        
        $this->close();
        return $idList['feedback'];
    }

    private function getPrimaryKeyRecord($value, $table, $idName, $valueName)
    {
        $selectQuery="SELECT `$idName` from `$table` WHERE `$valueName`='$value'";
        $insertQuery="INSERT INTO `$table` (`$valueName`) VALUES ('$value')";

        $result=-1;
        $queryResult=mysqli_query($this->link, $selectQuery) or die("Ошибка " . mysqli_error($this->link));
        if (mysqli_num_rows($queryResult)) {
            $row=mysqli_fetch_row($queryResult);
            $result=$row[0];
        } else {
            $result=mysqli_query($this->link, $insertQuery) or die("Ошибка " . mysqli_error($this->link));
            $result=mysqli_insert_id($this->link);
        }
        return $result;
    }
}
