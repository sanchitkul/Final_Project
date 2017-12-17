<?php
/**
 * Created by PhpStorm.
 * User: kwilliams
 * Date: 11/27/17
 * Time: 5:32 PM
 */


//each page extends controller and the index.php?page=tasks causes the controller to be called
class tasksController extends http\controller
{
    //each method in the controller is named an action.
    //to call the show function the url is index.php?page=task&action=show
    public static function show()
    {
        $record = todos::findOne($_REQUEST['id']);
        self::getTemplate('show_task', $record);
    }

    //to call the show function the url is index.php?page=task&action=list_task

    public static function all()
    {
        if(key_exists('userID',$_SESSION)) {
           $userID = $_SESSION['userID'];
        } else {
           header("Location: index.php?page=accounts&action=all");
        }
        $userID = $_SESSION['userID'];
        $records = todos::findTasksbyID($userID);
        
        self::getTemplate('all_tasks', $records);
        
    }

    public static function allOneUser()
    {
        $record = todos::findTasksbyID($_REQUEST['id']);
        self::getTemplate('all_tasks', $record);
    }


    public static function create()
    {
        self::getTemplate('new_task');
    }
    // this is function to add task
    
    public static function addTask()
    {
        session_start();
        $record = new todo();
        $record->owneremail = $_SESSION["userEmail"];
        $record->ownerid = $_SESSION["userID"];
        $record->createddate = $_POST['createddate'];
        $record->duedate = $_POST['duedate'];
        $record->message = $_POST['message'];
        $record->isdone = $_POST['isdone'];
        $record->save();
        header('Location: index.php?page=tasks&action=allOneUser&id='.$_SESSION["userID"]);
    }

   //this is the function to view edit record form
   
    public static function update()
    {
        $records = todos::findOne($_REQUEST['id']);
        $record = new todo();
        $record->id=$records->id;
        $record->owneremail=$_POST['owneremail'];
        $record->ownerid=$_POST['ownerid'];
        $record->createddate=$_POST['createddate'];
        $record->duedate=$_POST['duedate'];
        $record->message=$_POST['message'];
        $record->isdone=$_POST['isdone'];
        $record->save();
        session_start();
        header('Location: index.php?page=tasks&action=allOneUser&id='.$_SESSION["userID"]);
    }
}
   //this is function to delete task
    public static function delete()
    {
        $record = todos::findOne($_REQUEST['id']);
        $record->delete();
        session_start();
        header('Location: index.php?page=tasks&action=allOneUser&id='.$_SESSION["userID"]);
        
    }

}
