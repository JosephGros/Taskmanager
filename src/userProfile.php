<?php

session_start();
include "crud.php";
$userCRUD = new userDAO();
$taskCRUD = new taskDAO();
$username = $userCRUD->getUsername();
$userInfo = $userCRUD->getUserInfo();
$userArr = array();

foreach($userInfo as $user){
    $userArr[] = $user;
}

echo implode(" ", $userArr[1]);

// if(isset($_POST["createUsername"])){
//     $taskCRUD->createUser($_POST["createUsername"], $_POST["createPassword"], $_POST["createFirstname"],
//      $_POST["createLastname"], $_POST["createEmail"]);
// }
// if(isset($_GET["loginFailed"])){
//     print("<p>Wrong username or password. Try again!</p>");
// }
    
?>

<html lang="sv">
    <header>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>My Tasks</title>
    </header>

    <body>

    <section id="navbar">
        <ul id="nav">
            <li class="usernameDisplay"><?php echo "Taskmanager " . "<br>" . "User: " . implode(" ", $username[0]); ?></li>
            <li class="links"><a href="taskmanager.php">Home</a></li>
            <li class="links"><a href="userProfile.php">User settings</a></li>
            <li class="links"><a href="userTasks.php">My Tasks</a></li>
            <li class="links"><a href="logout.php">Logout</a></li>
        </ul>
    </section>

<html lang="sv">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="style.css">
<title>Create user</title>
<body>
    
<?php 

    

?>

<div class="createUserForm">
<h2>Create User</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    <input type="text" placeholder="<?php echo implode(" ", $username[0]); ?>" name="createUsername" id="createUsername" required><br>
    <input type="password" placeholder="Password" name="createPassword" id="createPassword" required>
    <input type="button" onclick="showPassword()" class="material-symbols-outlined" value="visibility_off" id="showBtn" required><br>
    <input type="text" placeholder="<?php echo implode(" ", $email[0]); ?>" name="createEmail" id="createEmail" required>
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

    </body>

</html>