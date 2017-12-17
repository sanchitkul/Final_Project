<?php
/**
 * Created by PhpStorm.
 * User: kwilliams
 * Date: 11/27/17
 * Time: 5:32 PM
 */
//each page extends controller and the index.php?page=tasks causes the controller to be called
class accountsController extends http\controller
{
    //each method in the controller is named an action.
    //to call the show function the url is index.php?page=task&action=show
    public static function show()
    {
        $record = accounts::findOne($_REQUEST['id']);
        self::getTemplate('show_account', $record);
    }
    //to call the show function the url is index.php?page=accounts&action=all
    public static function all()
    {
        $records = accounts::findAll();
        self::getTemplate('all_accounts', $records);
    }
    //to call the show function the url is called with a post to: index.php?page=task&action=create
    //this is a function to create new tasks
    //you should check the notes on the project posted in moodle for how to use active record here
    public static function signup()
    {
        self::getTemplate('new_user');
    }

    
    //this is to register an account i.e. insert a new account
  
    public static function register()
    {
        //https://www.sitepoint.com/why-you-should-use-bcrypt-to-hash-stored-passwords/
        //USE THE ABOVE TO SEE HOW TO USE Bcrypt
        self::getTemplate('register');
    }
    
    public static function show_profile()
    {
        session_start();
        $record = accounts::findOne($_SESSION['userID']);
        self::getTemplate('show_account', $record);
    }


    //this is the function to save the user the new user for registration
    public static function store()
    {
        $user = accounts::findUserbyEmail($_REQUEST['email']);
        if ($user == FALSE) {
            $record = new account();
            $record->email = $_POST['email'];
            $record->fname = $_POST['fname'];
            $record->lname = $_POST['lname'];
            $record->phone = $_POST['phone'];
            $record->birthday = $_POST['birthday'];
            $record->gender = $_POST['gender'];
            //$user->password = $_POST['password'];
            //this creates the password
            //this is a mistake you can fix...
            //Turn the set password function into a static method on a utility class.
            $user->password = $user->setPassword($_POST['password']);
            $record->save();
            //you may want to send the person to a
            // login page or create a session and log them in
            // and then send them to the task list page and a link to create tasks
            header('Location: index.php');
        } else {
            //You can make a template for errors called error.php
            // and load the template here with the error you want to show.
           // echo 'already registered';
            $error = 'already registered';
            self::getTemplate('error', $error);
        }
    }
    public static function edit()
    {
        session_start();
        $record = accounts::findOne($_SESSION['userID']);
        self::getTemplate('edit_account', $record);
    }
       public static function delete() {
        $record = accounts::findOne($_REQUEST['id']);
        $record->delete();
        header("Location: index.php?page=accounts&action=all");
    }
    public static function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
    //this is to login, here is where you find the account and allow login or deny.
    public static function login()
    {
        $record= new account();
        $record = accounts::findUserbyEmail($_POST['email']);
        if ($record == FALSE)
         {
            echo 'user not found';
         }
         else 
         {
            if($record->checkPassword($_POST['password']) == TRUE) {
                //echo 'login';
                session_start();
                $_SESSION["userID"] = $record->id;
                $_SESSION["userEmail"] = $record->email;
                //forward the user to the show all todos page
                print_r($_SESSION);
                header('Location: index.php?page=tasks&action=allOneUser&id='.$record->id);
            } 
            else 
            {
                echo 'password does not match';
            }
        }
    }
}
?>
