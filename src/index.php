<?php 

// Login page

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
    <title>Login Taskmanager</title> 
</head>
<body>

<h1 id="loginTitle">Taskmanager</h1>

<div class="loginForm">
<h2>Login</h2>
<br><br>
<form method="post" action="login.php">
    <input type="text" placeholder="Username" name="loginUsername" id="loginUsername"><br>
    <input type="password" placeholder="Password" name="loginPassword" id="loginPassword">
    <input type="button" onclick="showPassword()" class="material-symbols-outlined" value="visibility_off" id="showBtn">
    <br>
    <input type="submit" value="Login" id="login">
    <button id="createUser"><a href="createuser.php">Create user</a></button>
</form> 
</div>

</body>

<script>

    function showPassword(){
        let password = document.getElementById('loginPassword');
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