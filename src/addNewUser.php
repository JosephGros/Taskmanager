<?php
include "crud.php";
$taskCRUD = new userDAO();
if(isset($_POST["createUsername"])){
        $taskCRUD->createUser($_POST["createUsername"], $_POST["createPassword"], $_POST["createFirstname"],
         $_POST["createLastname"], $_POST["createEmail"]);
         header("location: index.php");
    }
    if(isset($_GET["loginFailed"])){
        print("<p>Wrong username or password. Try again!</p>");
    }