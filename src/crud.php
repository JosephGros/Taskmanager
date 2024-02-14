<?php
// global $userId;
// $userId = $_SESSION["userId"];
// echo "User ID is:" . $userId;
// session_start();

class userDAO {
    private $conn;

    function __construct() {
        $servername="db";
        $user="root";
        $pass="mariadb";
        $dbname="taskmanager";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
        } catch (PDOException $error){
            echo "Connection failed: " . $error->getMessage();
        }
    }

    private function sanitera($input){
        return htmlspecialchars(strip_tags($input));
    }

    function createUser($username, $password, $firstname, $lastname, $email){
        $username = $this->sanitera($username);
        $password = $this->sanitera($password);
        $firstname = $this->sanitera($firstname);
        $lastname = $this->sanitera($lastname);
        $email = $this->sanitera($email);

        $password = password_hash($password, PASSWORD_BCRYPT);

        $query=<<<SQL
        INSERT INTO users (username, password, firstName, lastName, email)
        VALUES (:username, :password, :firstname, :lastname, :email)
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam("username", $username);
            $stmt->bindParam("password", $password);
            $stmt->bindParam("firstname", $firstname);
            $stmt->bindParam("lastname", $lastname);
            $stmt->bindParam("email", $email);
            $stmt->execute();
        } catch (PDOException $error){
            echo "Connection failed: " . $error->getMessage();
        }
    }

    function loginUser($username, $password){
        $query=<<<SQL
        SELECT userId, password FROM users WHERE username=:username;
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam("username", $username);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();

            if(empty($result)){
                return false;
            }
            if(password_verify($password, $result['password'])){
                return $result['userId'];
            }
            return false;
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
        }
    }

    function getUsername(){

        $userId = $_SESSION["userId"];

        $query=<<<SQL
        SELECT username FROM users WHERE userId = $userId;
        SQL;

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
        }
    }

    function getUserInfo(){

        $userId = $_SESSION["userId"];

        $query=<<<SQL
        SELECT firstName, lastName FROM users WHERE userId = $userId;
        SQL;

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
        }
    }

    function deleteUser($userId){

        $query=<<<SQL
        DELETE FROM users WHERE userId = $userId
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rowsAffected = $stmt->rowCount();

            return $rowsAffected > 0;
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
            return false;
        }
    }

}


class taskDAO {
    private $conn;

    function __construct() {
        $servername="db";
        $user="root";
        $pass="mariadb";
        $dbname="taskmanager";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
        } catch (PDOException $error){
            echo "Connection failed: " . $error->getMessage();
        }
    }

    public function getConn() {
        return $this->conn;
    }

    private function sanitera($input){
        return htmlspecialchars(strip_tags($input, 'äåö'));
    }

    function createTask($taskTitle, $taskDiscription){
        $taskTitle = $this->sanitera($taskTitle);
        $taskDiscription = $this->sanitera($taskDiscription);

        $query=<<<SQL
        INSERT INTO tasks (taskTitle, taskDiscription, userId)
        VALUES (:taskTitle, :taskDiscription, :userId)
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam("taskTitle", $taskTitle);
            $stmt->bindParam("taskDiscription", $taskDiscription);
            $stmt->bindParam("userId", $_SESSION["userId"]);
            $stmt->execute();
        } catch (PDOException $error){
            echo "Connection failed: " . $error->getMessage(); 
        }
    }

    function getAllTasks(){

        $userId = $_SESSION["userId"];
        
        $query=<<<SQL
        SELECT taskTitle, taskStatus, taskId, taskDiscription FROM tasks WHERE userId = $userId;
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
        }


    }

    function editTask($taskId){
    
        $query=<<<SQL
        SELECT taskTitle, taskDiscription FROM tasks WHERE taskId = $taskId;
        SQL;
    
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
        }
    
    
    }

    function updateTask($taskTitle, $taskDiscription, $taskId){
        $taskTitle = $this->sanitera($taskTitle);
        $taskDiscription = $this->sanitera($taskDiscription);

        $query=<<<SQL
        UPDATE tasks
        SET taskTitle = :taskTitle, taskDiscription = :taskDiscription
        WHERE taskId = $taskId
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam("taskTitle", $taskTitle);
            $stmt->bindParam("taskDiscription", $taskDiscription);
            $stmt->execute();
        } catch (PDOException $error){
            echo "Connection failed: " . $error->getMessage(); 
        }
    }

    function deleteTask($taskId){

        $query=<<<SQL
        DELETE FROM tasks WHERE taskId = $taskId
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rowsAffected = $stmt->rowCount();

            return $rowsAffected > 0;
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
            return false;
        }
    }

    function deleteAllMarked($userId){

        $query=<<<SQL
        DELETE FROM tasks WHERE taskStatus = 1 && userId = $userId
        SQL;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rowsAffected = $stmt->rowCount();

            return $rowsAffected > 0;
        } catch (PDOException $error){
            echo "Error: " . $error->getMessage();
            return false;
        }
    }

    function markAllTasks($userId){

        $query=<<<SQL
        UPDATE tasks
        SET taskStatus = ABS(taskStatus -1)
        WHERE userId = $userId
        SQL;
    try{
        $updateTask = $this->conn->prepare($query);
        $updateTask->execute();
    } catch(PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }
    
    
    
}