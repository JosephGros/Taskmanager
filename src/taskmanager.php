<?php 
session_start();
/* Taskmanager */
include "crud.php";
$userCRUD = new userDAO();
$taskCRUD = new taskDAO();
$username = $userCRUD->getUsername();
// $userId = $_SESSION["userId"];
// echo "User ID is:" . $userId;


?>

<html lang="sv">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>Taskmanager</title> 
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

    <h1 id="welcomeTitle">Welcome <?php echo implode(" ", $username[0]); ?> to Taskmanager</h1>

    <p id="welcomeMsg">Create new tasks or view your already created tasks below!</p>
    
    <button class="choiceBtns"><a href="createTask.php" id="createLink">New Task</a></button>
    <button class="choiceBtns"><a href="userTasks.php" id="createLink">My Tasks</a></button>


    </body>

</html>