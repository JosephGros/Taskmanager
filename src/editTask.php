<?php 

/* Taskmanager */
session_start();
include "crud.php";
$userCRUD = new userDAO();
$taskCRUD = new taskDAO();
$username = $userCRUD->getUsername();

if(isset($_POST["taskTitle"])){
    $taskCRUD->updateTask($_POST["taskTitle"], $_POST["taskDescription"], $_POST["taskId"]);
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
    <title>Edit task</title> 
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

    <?php

    if(isset($_POST['taskId'])) {
        $taskId = $_POST['taskId'];
        $taskDetails = $taskCRUD->editTask($taskId);

        if($taskDetails){
            echo " <p id='createTaskMsg'>Edit Task</p>

            <div id='createTaskForm'>
            <form method='post' action='{$_SERVER['PHP_SELF']}'>
            <input type='text' placeholder='Task title' name='taskTitle' id='taskTitle' value='{$taskDetails[0]['taskTitle']}'><br>
            <textarea name='taskDescription' placeholder='Task Description...' id='taskDescription'>{$taskDetails[0]['taskDiscription']}</textarea>
            <input type='hidden' value='$taskId' name='taskId'>
            <input type='submit' value='Update Task' id='createSubmit'>
            </form>
            </div>";
        } else {
            echo "Task not found";
        };

    } else {
        echo "TaskId not provided";
    };

    ?>

    </body>

</html>