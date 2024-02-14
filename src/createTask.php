<?php 

/* Taskmanager */
session_start();
include "crud.php";
$userCRUD = new userDAO();
$taskCRUD = new taskDAO();
$username = $userCRUD->getUsername();

if(isset($_POST["taskTitle"])){
    $taskCRUD->createTask($_POST["taskTitle"], $_POST["taskDescription"], $_POST["userId"]);
    header("Location: userTasks.php");
}

?>

<html lang="sv">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>Create task</title> 
    </head>

    <body>

    <section id="navbar">
        <ul id="nav">
            <li class="usernameDisplay"><a id="userIcon" href="deleteUser.php"><?php echo "Taskmanager " . "<br>" . "User: " . implode(" ", $username[0]); ?></a></li>
            <li class="links"><a href="taskmanager.php">Home</a></li>
            <li class="links"><a href="userTasks.php">My Tasks</a></li>
            <li class="links"><a href="logout.php">Logout</a></li>
        </ul>
    </section>

    <p id="createTaskMsg">Create your new task below!</p>

    <div id="createTaskForm">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    <input type="text" placeholder="Task title" name="taskTitle" id="taskTitle"><br>
    <textarea name="taskDescription" placeholder="Task Description..." id="taskDescription"></textarea>
    <input type="hidden" value="<?php echo $userId ?>" name="userId">
    <input type="submit" value="Create Task" id="createSubmit">
    </form>
    </div>

    </body>

</html>