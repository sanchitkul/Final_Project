<?php
class accounts extends \database\collection
{
    protected static $modelName = 'account';
    public static  function findUserbyUsername($login) {
    $tableName = get_called_class();
    $sql = 'SELECT * FROM ' .$tableName . ' WHERE email ="' . $login.'"';
    $recordsSet = self::getResults($sql);
    if (is_null($recordsSet)) 
    {
       echo "False";
       return FALSE;
    } 
    else 
    {
       echo "True";
       return $recordsSet[0];
    }

    }
}
?>
