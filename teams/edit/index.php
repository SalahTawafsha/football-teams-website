<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Edit Team</title>
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
        <li><h3>Edit Team</h3></li>
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
        $teamName = $_GET["name"];
        echo "<br>";
        echo "<li><a href='../details/delete.php?name=$teamName'>Delete Team</a></li>";
        ?>
    </ul>
</nav>
<main>

    <br>

    <?php
    include_once "../../db_connect.inc";

    $connection = connect();

    session_start();

    if (!isset($_SESSION["email"]))
        header("location: ../../index.php");

    if(isset($_GET["success"]) )
        if($_GET["success"] == "true")
            echo "<p class='fill-green'>Team edited successfully</p>";
        else
            echo "<p class='error'>Team edit failed, This name of team is already exist</p>";


    $email = $_SESSION["email"];


    $sql = $connection->prepare("select * from team where email = :email AND name=:team_name;");

    $sql->bindParam(":email", $email);
    $sql->bindParam(":team_name", $teamName);

    $sql->execute();

    $row = $sql->fetchAll();

    if (count($row) == 0)
        header("location: ../../dashboard.php");

    $skillLevel = $row[0]["skill_level"];
    $gameDay = $row[0]["game_day"];

    ?>
    <br>
    <p>If field background is <span class="fill-green">GREEN</span>, then it's required.</p>
    <form action="edit.php" method="post">
        <input hidden="hidden" class="simple-input" type="text" name="oldName" id="oldName"
               value="<?php echo $teamName ?>">
        <table>
            <tr>
                <td>
                    <label class="simple-label" for="name">Team Name:</label>
                </td>
                <td><input required class="simple-input" type="text" name="name" id="name" value="<?php echo $teamName ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="simple-label" for="skillLevel">Skill Level (1-5):</label>
                </td>
                <td><input type="number" id="skillLevel" min="1" max="5" name="skillLevel" required
                           value="<?php echo $skillLevel ?>"></td>
            </tr>
            <tr>
                <td>
                    <label class="simple-label" for="gameDay">Game Day:</label>
                </td>
                <td><select name="gameDay" id="gameDay">
                        <option value="Saturday" <?php echo ($gameDay == 'Saturday') ? 'selected' : '' ?>>Saturday
                        </option>
                        <option value="Sunday" <?php echo ($gameDay == 'Sunday') ? 'selected' : '' ?>>Sunday
                        </option>
                        <option value="Monday" <?php echo ($gameDay == 'Monday') ? 'selected' : '' ?>>Monday
                        </option>
                        <option value="Tuesday" <?php echo ($gameDay == 'Tuesday') ? 'selected' : '' ?>>Tuesday
                        </option>
                        <option value="Wednesday" <?php echo ($gameDay == 'Wednesday') ? 'selected' : '' ?>>
                            Wednesday
                        </option>
                        <option value="Thursday" <?php echo ($gameDay == 'Thursday') ? 'selected' : '' ?>>
                            Thursday
                        </option>
                        <option value="Friday" <?php echo ($gameDay == 'Friday') ? 'selected' : '' ?>>Friday
                        </option>
                    </select></td>
            </tr>
        </table>
        <br>
        <input id="submit" type="submit">
    </form>
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