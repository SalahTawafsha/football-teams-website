<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Team Details</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
<header>
    <ul class="horizontal-items">
        <li>
            <ul class="horizontal-items">
                <li><a href="../../dashboard.php">
                        <ul class="horizontal-items">
                            <li><img src="../../logo.png" alt="Site icon"></li>
                            <li>Dashboard</li>
                        </ul>
                    </a></li>
                <li>
                <li><a href="../../../index.html">My Profile</a></li>
            </ul>
        </li>
        <li><h3>Team Details</h3></li>
        <li>
            <ul class="horizontal-items">
                <li><a href="../../about.html">about us</a></li>
                <li><a href="../../log_out.php">log out</a></li>
            </ul>
        </li>
    </ul>
</header>

<nav>
    <ul>
        <li><a href="../new/index.php">Create New Team</a></li>
        <?php
        include_once "../../db_connect.inc";

        $connection = connect();

        session_start();

        if (!isset($_GET["name"]))
            header("location: ../../index.php");


        if (!isset($_SESSION["email"]))
            header("location: ../../index.php");

        $email = $_SESSION["email"];

        $teamName = $_GET["name"];

        $sql = $connection->prepare(
            "SELECT IF(email = :email, 'Yes', 'No') AS isMine FROM team where name=:name;");

        $sql->bindParam(":email", $email);
        $sql->bindParam(":name", $teamName);

        $sql->execute();

        $row = $sql->fetchAll();

        $isMine = $row[0]["isMine"] == "Yes" ? "true" : "false";


        if ($isMine == "true") {
            echo "<br>";
            echo "<li><a href='../edit/index.php?name=$teamName''>Edit Team</a></li>";
            echo "<br>";
            echo "<li><a href='delete.php?name=$teamName'>Delete Team</a></li>";
        } ?>
    </ul>
</nav>
<main>
    <?php


    $sql = $connection->prepare("select * from team where name=:team_name;");

    $sql->bindParam(":team_name", $teamName);

    $sql->execute();

    $row = $sql->fetchAll();

    if (count($row) == 0)
        header("location: ../../dashboard.php");

    $skillLevel = $row[0]["skill_level"];
    $gameDay = $row[0]["game_day"];


    $playersQuery = $connection->prepare("select count(*) AS 'count' from player where team_name  = :team_name;");

    $playersQuery->bindParam(":team_name", $teamName);

    $playersQuery->execute();

    $playersRow = $playersQuery->fetchAll();

    $count = $playersRow[0]["count"];

    echo "<h1>$teamName</h1>";
    ?>

    <br>

    <br>

    <strong>Team Name:</strong>
    <?php
    echo $teamName;
    ?>

    <br>

    <strong>Skill Level:</strong>
    <?php
    echo $skillLevel;
    ?>

    <br>

    <strong>Game Day:</strong>
    <?php
    echo $gameDay;
    ?>

    <br>

    <strong>Players:</strong>
    <?php
    if ($count == 0)
        echo "Team is Empty";
    else {
        echo "<ol class='arabic-numbering'>";
        $playersQuery = $connection->prepare("select player_name from player where team_name  = :team_name;");

        $playersQuery->bindParam(":team_name", $teamName);

        $playersQuery->execute();

        $playersRow = $playersQuery->fetchAll();

        foreach ($playersRow as $value)
            echo "<li>" . $value['player_name'] . "</li>";

        // echo "<ol><li>Test</li></ol>"; // for testing
        echo "</ol>";
    }
    ?>


    <?php if ($count < 9 && $isMine == "true") : ?>

        <h2>Add Player:</h2>
        <p>If field background is <span class="fill-green">GREEN</span>, then it's required.</p>
        <form action="addPlayer.php" method="post">
            <table>
                <tr>
                    <td>
                        <label class="simple-label" for="playerName">Player Name:</label>
                    </td>
                    <td><input id="playerName" type="text" name="playerName" required></td>
                </tr>

                <?php
                echo "<input type='hidden' name='teamName' value='$teamName'>";
                ?>
            </table>
            <br>
            <input id="submit" type="submit" value="Add">
        </form>
    <?php elseif ($isMine == "true") : echo "<strong>Team is Full</strong>"; endif; ?>
    <br>


    <?php
    if ($isMine == "true") {
        echo "<a class='custom-button' href='../edit/index.php?name=$teamName'>edit</a>";

        echo "<br>";

        echo "<a class='custom-button' href='delete.php?name=$teamName'>delete</a>";
    }
    ?>
</main>
<footer>
    <ul class="horizontal-items">

        <li>
            <p>&copy 2023 Salah Tawafsha 1200339</p>
        </li>
        <li>
            <p>salaht321@gmail.com</p>
        </li>
        <li>
            <p>0592485699</p>
        </li>
    </ul>
</footer>
</body>

</html>