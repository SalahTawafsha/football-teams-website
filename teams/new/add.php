<?php
include_once "../../db_connect.inc";

session_start();

$name = $_POST["name"];
$skillLevel = $_POST["skillLevel"];
$gameDay = $_POST["gameDay"];
$email = $_SESSION["email"];


$connection = connect();

$stm = $connection->prepare("insert into team (name,skill_level,game_day,email) values (:name,:skill_level,:game_day,:email) ;");

try {
    $stm->bindParam(":name", $name);
    $stm->bindParam(":skill_level", $skillLevel);
    $stm->bindParam(":game_day", $gameDay);
    $stm->bindParam(":email", $email);

    $stm->execute();
    header("location: index.php?msg=1");
} catch (PDOException $e) {
    header("location: index.php?msg=2");
}
