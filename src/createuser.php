<?php 

// Create user page

include "crud.php";
$taskCRUD = new userDAO();

?>


<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>Create user</title> 
</head>
<body>

<h1 id="createUserTitle">Welcome to Taskmanager</h1>

<div class="createUserForm">
<h2>Create User</h2>
<form method="post" action="addNewUser.php">
    <input type="text" placeholder="Username" name="createUsername" id="createUsername" required><br>
    <input type="password" placeholder="Password" name="createPassword" id="createPassword" required>
    <input type="button" onclick="showPassword()" class="material-symbols-outlined" value="visibility_off" id="showBtn" required><br>
    <input type="text" placeholder="Firstname" name="createFirstname" id="createFirstname" required><br>
    <input type="text" placeholder="Lastname" name="createLastname" id="createLastname" required><br>
    <input type="text" placeholder="Email" name="createEmail" id="createEmail" required>
    <br>
    <input type="submit" value="Create" id="createbtn">
    <button id="loginPage"><a href="index.php">Login</a></button>
</form>
</div>

</body>

<script>

    function showPassword(){
        let password = document.getElementById('createPassword');
        let showBtn = document.getElementById('showBtn');
        if(password.type === "password"){
            password.type = "text";
            showBtn.value = "visibility";
        } else {
            password.type = "password";
            showBtn.value = "visibility_off";
        }
    }
</script>

</html>