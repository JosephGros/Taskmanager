<?php

session_start();
include "crud.php";
$userCRUD = new userDAO();
$taskCRUD = new taskDAO();
$username = $userCRUD->getUsername();
$userInfo = $userCRUD->getUserInfo();

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action === 'deleteUser'){
        $userCRUD->deleteUser($_SESSION['userId']);
        header("location: index.php");
        }
}
    
?>

<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>User settings</title> 
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

    <section id="taskListSec">
        <table id="taskList">
            <tr class='mainTR'>
                <th class='taskTitleTable'><?php echo implode(" ", $username[0]); ?></th>
                <th class="taskDone">New Task</th>
                <th class="taskDone">Delete User</th>
            </tr>
            <tr class="mainTR">
                <th class="userInfo"><?php echo "User info - " . implode(" ", $userInfo[0]); ?></th>
                <th class="taskDoneCheck">
                    <button class="newMark"><a href="createTask.php" id="createLink"><span class="material-symbols-outlined"> add </span></a></button>
                </th>
                <th class="taskBtns2">
                    <form method="post" action="" id="deleteUser">
                        <input type="hidden" name="action" value="deleteUser" />
                        <button type="button" class="deleteBtns" onclick="deleteConfirm()"><span class="material-symbols-outlined"> delete </span></button>
                        </form>
                </th>
            </tr>

        </table>  
    </section>

    <script>
        function deleteConfirm(){
            let deleteForm = document.getElementById("deleteUser");

            if(window.confirm("Are you sure you want to delete user?") == true){
                deleteForm.submit();
            } else {
                return;
            }
        }
    </script>