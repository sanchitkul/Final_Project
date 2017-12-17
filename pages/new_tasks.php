
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>New Task</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <!--<link rel="stylesheet" href="css/styles.css?v=1.0">-->

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <![endif]-->
</head>

<body>


<form action="index.php?page=tasks&action=store" method="post">
    Owner Email: <input type="text" name="owneremail"><br/>
    Owner ID: <input type="text" name="ownerid"><br/>
    Create Date: <input type="text" name="createddate"><br/>
    Due Date: <input type="text" name="duedate"><br/>
    Message: <input type="text" name="message"><br/>
    Is Done: <input type="text" name="isdone"><br/><br>
    <input type="submit" value="Add Task">
    
</form>
<a href="index.php?page=tasks&action=all">Back to all tasks</a>

<script src="js/scripts.js"></script>
</body>
</html>
