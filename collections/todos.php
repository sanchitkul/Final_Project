<?php
class todos extends database\collection
{
    protected static $modelName = 'todo';
    
    public static  function findTasksbyID($userid) {
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE ownerid ="' . $userid.'"';
        $recordsSet = self::getResults($sql);
        return $recordsSet;
    }
}
?>
