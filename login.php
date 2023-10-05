<?php
include_once "db_connect.inc";

$email = $_POST["email"];
$password = $_POST["password"];


$connection = connect();

$stm = $connection->prepare("select password from user where email = :email;");

$stm->bindParam(":email", $email);

$stm->execute();

$row = $stm->fetchAll();

if ($row != null) {
    if ($password == $row[0]["password"]) {
        session_start();
        session_start();

        $_session["email"] = $email;

        $_SESSION["email"] = $email;

        header("location: dashboard.php");
    } else
        header("location: index.php?error=3");
} else
    header("location: index.php?error=4");
