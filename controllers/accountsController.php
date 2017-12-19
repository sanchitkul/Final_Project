<?php

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
        public static function register()
    {
        self::getTemplate('register');
    }
    
    public static function store()
    {
        $user = accounts::findUserbyEmail($_REQUEST['email']);
        if ($user == FALSE) 
        {
            $user = new account();
            $user->email = $_POST['email'];
            $user->fname = $_POST['fname'];
            $user->lname = $_POST['lname'];
            $user->phone = $_POST['phone'];
            $user->birthday = $_POST['birthday'];
            $user->gender = $_POST['gender'];
            $user->password = $user->setPassword($_POST['password']);
            $user->save();
            header("Location: index.php");
        } 
        else 
        {
            $error = 'already registered';
            self::getTemplate('error', $error);
        }
    }
    public static function edit()
    {
        $record = accounts::findOne($_REQUEST['id']);
        self::getTemplate('edit_account', $record);
    }
//this is used to save the update form data
    public static function save() 
    {
        $user = accounts::findOne($_REQUEST['id']);
        $user->email = $_POST['email'];
        $user->fname = $_POST['fname'];
        $user->lname = $_POST['lname'];
        $user->phone = $_POST['phone'];
        $user->birthday = $_POST['birthday'];
        $user->gender = $_POST['gender'];
        $user->save();
        session_start();
        header('Location: index.php?page=tasks&action=oneUser&id='.$user->id);
    }

    public static function show_profile()
    {
        session_start();
        $record = accounts::findOne($_SESSION['userID']);
        self::getTemplate('show_account', $record);
    }
    public static function edit_profile()
    {
        session_start();
        $record = accounts::findOne($_SESSION['userID']);
        self::getTemplate('edit_account', $record);
    }

   



    public static function delete() 
    {
        $record = accounts::findOne($_REQUEST['id']);
        $record->delete();
        header("Location: index.php?page=accounts&action=all");
    }
    //this is to login, here is where you find the account and allow login or deny.
    public static function login()
    {
        $user = accounts::findUserbyEmail($_REQUEST['email']);
        if ($user == FALSE) 
        {
            echo 'user not found';
        } 
        else 
        {
            if($user->checkPassword($_POST['password']) == TRUE) 
            {
               
                session_start();
                $_SESSION["userID"] = $user->id;
                $_SESSION["userEmail"] = $user->email;
                header('Location: index.php?page=tasks&action=oneUser&id='.$user->id);
            } 
            else 
            {
                echo 'password does not match';
            }
        }
    }
     public static function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
}
