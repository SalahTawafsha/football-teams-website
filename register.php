<?php
include_once "db_connect.inc";

$userName = $_POST["userName"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];

if ($password  == $confirmPassword)
    if (strlen($_POST["password"]) >= 8) {

        $connection = connect();

        $stm = $connection->prepare("insert into user (name,email, password) values (:name,:email,:password) ;");

        try {
            $stm->bindParam(":name", $userName);
            $stm->bindParam(":email", $email);
            $stm->bindParam(":password", $password);

            $stm->execute();
            header("location: index.php?msg=1");
        } catch (PDOException $e) {
            header("location: index.php?msg=2");
        }
    } else {
        header("location: index.php?error=1");
    }
else
    header("location: index.php?error=2");
