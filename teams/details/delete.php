<?php
include_once "../../db_connect.inc";

session_start();

$teamName = $_GET["name"];
$email = $_SESSION["email"];

$connection = connect();

$stm = $connection->prepare("DELETE FROM `team` where name =:name and email=:email;");

try {
    $stm->bindParam(":name", $teamName);
    $stm->bindParam(":email", $email);

    $stm->execute();
    header("location: ../../dashboard.php");
} catch (PDOException $e) {
    echo $e;
    header("location: index.php?error=1");
}
