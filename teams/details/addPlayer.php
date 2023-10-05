<?php
include_once "../../db_connect.inc";


$playerName = $_POST["playerName"];
$teamName = $_POST["teamName"];


$connection = connect();

$stm = $connection->prepare("insert into player (player_name ,team_name) values (:player_name,:team_name) ;");

try {
    $stm->bindParam(":player_name", $playerName);
    $stm->bindParam(":team_name", $teamName);

    $stm->execute();
    header("location: index.php?name=$teamName&isMine=true");
} catch (PDOException $e) {
    echo $e;
    header("location: index.php?name=$teamName&isMine=true");
}
