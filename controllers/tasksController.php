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
        $record = todos::findOne($_REQUEST['3']);
        self::getTemplate('show_task', $record);
    }

    //to call the show function the url is index.php?page=task&action=list_task

    public static function all()
    {
        $records = todos::findAll();
        //session_start();
        //$records = todos::findTasksbyID('$uderID')
        //$records
        self::getTemplate('all_tasks', $records);
        //$userID = $_SESSION['userID'];

    }

    public static function one()
    {
        $record = todos::findOne(2);
        self::getTemplate('one_task',$record);
    }
    //to call the show function the url is called with a post to: index.php?page=task&action=create
    //this is a function to create new tasks

    //you should check the notes on the project posted in moodle for how to use active record here

    public static function create()
    {
	 $record = '';
         self::getTemplate('create_task', $record);
        
    }

    //this is the function to view edit record form
    public static function edit()
    {
        $record = todos::findOne($_REQUEST['id']);

        self::getTemplate('edit_task', $record);

    }

    //this would be for the post for sending the task edit form
    public static function store()
    {
        session_start();

        //$record = todos::findOne($_REQUEST['id']);
        //$record->body = $_REQUEST['body'];
        //$record->save();
        $upRecord = new todo();
        $record->body = $_REQUEST['body'];
        
        $upRecord->id = $_REQUEST['id'];
        $upRecord->owneremail = $_POST['owneremail'];
        $upRecord->duedate = $_POST['duedate'];
        $upRecord->message = $_POST['message'];
        $upRecord->save();
        echo $upRecord;
        self::getTemplate('show_task', $record);
        print_r($_POST);

    }
    
   public static function delete()
   {
        $record = todos::findOne($_REQUEST['id']);
		$record->delete();
        echo 'Deleted todo id: ' . $_REQUEST['id'];
     	$records = todos::findAll();
        self::getTemplate('all_tasks', $records);
    }
    
    private static function validate($record) 
    {
			return true;
	}

}
