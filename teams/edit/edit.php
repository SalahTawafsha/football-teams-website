<?php
include_once "../../db_connect.inc";

$connection = connect();

session_start();

print_r($_POST);
$oldName = $_POST["oldName"];
$name = $_POST["name"];
$skillLevel = $_POST["skillLevel"];
$gameDay = $_POST["gameDay"];
$email = $_SESSION["email"];


$sql = $connection->prepare("update team set name=:name, skill_level=:skill_level, game_day=:game_day where email = :email AND name=:team_name;");

$sql->bindParam(":skill_level", $skillLevel);
$sql->bindParam(":game_day", $gameDay);
$sql->bindParam(":email", $email);
$sql->bindParam(":name", $name);
$sql->bindParam(":team_name", $oldName);


try {
    $sql->execute();
    header("location: index.php?name=$name&success=true");
} catch (Exception $e) {
    header("location: index.php?name=$oldName&success=false");
}
