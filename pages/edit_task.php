<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="css/styles.css?v=1.0">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>

<body>

<form action="index.php?page=tasks&action=update&id=<?php echo $data->id; ?>" method="post">

    Created Date : <input type="text" name="createddate" id='createddate' value="<?php echo $data->createddate; ?>"><br>

    Due Date: <input type="text" name="duedate" id='duedate' value="<?php echo $data->duedate; ?>"><br>
    Message: <input type="text" name="message" id='message' value="<?php echo $data->message; ?>"><br>
    Isdone: <input type="text" name="isdone" id="isdone" value="<?php echo $data->isdone; ?>"><br>
    
    <input type="submit" value="Submit form">
</form>

<script src="js/scripts.js"></script>
</body>
</html>
