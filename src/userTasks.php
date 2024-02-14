<?php

session_start();
include "crud.php";
$userCRUD = new userDAO();
$taskCRUD = new taskDAO();
$username = $userCRUD->getUsername();
        
    if (isset($_POST['checkbox'])) {
        try {
            $updateTask = $taskCRUD->getConn()->prepare(
                                "UPDATE tasks
                                 SET taskStatus={$_POST['checkbox']}
                                 WHERE taskId={$_POST['id']}"
                              );
            
            $updateTask->execute();
        } catch(PDOException $error) {
            echo "Error: " . $error->getMessage();
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
    <title>My Tasks</title> 
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
    
            if($taskCRUD->deleteTask($taskId)){
                echo "<p class='deleteMsg'>Task deleted successfully!</p>";
                echo '<img src="./img/clappinghobbits.gif" alt="hobbits">';
            } else {
                echo "<p class='deleteMsg'>Failed to delete task!</p>";
            };
        }

        if(isset($_POST['markAction'])) {
            $action = $_POST['markAction'];
    
            if($action === 'markAll'){
                if($taskCRUD->markAllTasks($_SESSION['userId'])){
                    echo '<p class="deleteMsg">Good job!</p>';
                } 
        }
        }

        if(isset($_POST['action'])) {
            $action = $_POST['action'];
    
            if($action === 'deleteTask'){
                if($taskCRUD->deleteAllMarked($_SESSION['userId'])){
                    echo "<p class='deleteMsg'>All marked tasks have been deleted successfully!</p>";
                    echo '<img src="./img/clappinghobbits.gif" alt="hobbits">';
                } else {
                    echo "<p class='deleteMsg'>Failed to delete marked task!</p>";
            };
        }
        }
    ?>
    <section id="taskListSec">
        <table id="taskList">
            <tr class='mainTR'>
                <th class='taskTitleTable'>Tasks</th>
                <th class="taskDone">Edit</th>
                <th class="taskDone">Done</th>
                <th class="taskDone">Delete</th>
            </tr>

    <?php
        
        echo '
        <tr class="mainTR">
        <th class="markTask"></th>
        <th class="taskDoneCheck">
            <button class="newMark"><a href="createTask.php" id="createLink"><span class="material-symbols-outlined"> add </span></a></button>
        </th>
        <th class="taskDoneCheck">
            <form method="post" action="">
            <input type="hidden" name="markAction" value="markAll" />
            <button type="submit" class="newMark"><span class="material-symbols-outlined"> task_alt </span></button>
            </form>
        </th>
        <th class="taskBtns2">
            <form method="post" action="" id="deleteTask">
            <input type="hidden" name="action" value="deleteTask" />
            <button type="button" class="deleteBtns" onclick="deleteConfirm()"><span class="material-symbols-outlined"> delete </span></button>
            </form>
            </th>
        </tr>';

    
        foreach($taskCRUD->getAllTasks() as $task) {
            echo "<tr class='firstTR'>";
            echo "<th class='taskTitles'>{$task['taskTitle']}</th>";

            if ($task['taskStatus']) {
                echo "
                <th class='taskBtns1'>
                <form method='post' action='editTask.php'>
                <input type='hidden' name='taskId' value='{$task['taskId']}' />
                <button type='submit' class='editBtns'><span class='material-symbols-outlined'> edit_note </span></button>
                </form>
                </th>
                <th class='taskDoneCheck'>
                    <form method='post' action='' id='form{$task['taskId']}' >
                        <input type='hidden' name='id' value='{$task['taskId']}' />
                        <input type='hidden' name='checkbox' id='checkboxHidden{$task['taskId']}' value=0 />
                        <input type='checkbox' name='checkbox' class='checkbox' id='checkbox{$task['taskId']}' value=1 onchange='change({$task["taskId"]})' checked />
                    </form>
                </th>
                <th class='taskBtns2'>
                <form method='post' action='{$_SERVER['PHP_SELF']}' id='deleteTask'>
                <input type='hidden' name='taskId' value='{$task['taskId']}' />
                <button type='submit' class='deleteBtns'><span class='material-symbols-outlined'> delete </span></button>
                </form>
                </th>
                ";
            } else {
                echo "
                <th class='taskBtns1'>
                <form method='post' action='editTask.php'>
                <input type='hidden' name='taskId' value='{$task['taskId']}' />
                <button type='submit' class='editBtns'><span class='material-symbols-outlined'> edit_note </span></button>
                </form>
                </th>
                <th class='taskDoneCheck'>
                    <form method='post' action='' id='form{$task['taskId']}' >
                            <input type='hidden' name='id'value={$task['taskId']} />
                            <input type='hidden' name='checkbox' id='checkboxHidden{$task['taskId']}' value=0 />
                            <input type='checkbox' name='checkbox' class='checkbox' id='checkbox{$task['taskId']}' value=1 onchange='change({$task["taskId"]})' />
                    </form>
                </th>
                <th class='taskBtns2'>
                <form method='post' action='{$_SERVER['PHP_SELF']}'>
                <input type='hidden' name='taskId' value='{$task['taskId']}' />
                <button type='submit' class='deleteBtns'><span class='material-symbols-outlined'> delete </span></button>
                </form>
                </th>
                ";
            }

            echo "</tr>";
            echo "<tr class='secondTR'>";
            echo "<td class='taskDescription'>{$task['taskDiscription']}</td>";
            echo "</tr>";
        }
    ?>

    </table>  
    </section>

    <script>
        function change(taskID) {
            if(document.getElementById(`checkbox${taskID}`).checked) {
                document.getElementById(`checkboxHidden${taskID}`).disabled = true;
            } else {
                document.getElementById(`checkboxHidden${taskID}`).disabled = false;
            }
            const form = document.getElementById(`form${taskID}`);
            form.submit();
        }

        function deleteConfirm(){
            let deleteForm = document.getElementById("deleteTask");

            if(window.confirm("Are you sure you want to delete this task?", src="./img/clappinghobbits.gif") == true){
                deleteForm.submit();
            } else {
                return;
            }
        }
    </script>

</body>

</html>