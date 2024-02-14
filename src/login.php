<?php
session_start();
// var_dump($_SESSION);
include "crud.php";
$userCRUD = new userDAO();

if(isset($_POST["loginUsername"])){
    if($loggedInUser = $userCRUD->loginUser($_POST["loginUsername"], $_POST["loginPassword"])){
        $_SESSION["userId"] = $loggedInUser;
        header("Location: taskmanager.php?success");
    } else {
        header("Location: index.php?loginFailed");
    }
}