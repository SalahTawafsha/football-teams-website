<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Create New Team</title>
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
        <li><h3>New Team</h3></li>
        <li>
                <ul class="horizontal-items">
                    <li><a href="../../about.html">about us</a></li>
                    <li><a href="../../log_out.php">log out</a></li>
                </ul>
        </li>
    </ul>
</header>

<main>
    <?php
    session_start();

    if (!isset($_SESSION["email"]))
        header("location: ../../index.php");

    if (isset($_GET["msg"]))
        if ($_GET["msg"] == 1)
            echo "<p>Team added successfully</p>";
        else if ($_GET["msg"] == 2)
            echo "<p class='error'>Team is already exist !</p>";
    ?>

    <br>

    <p>If field background is <span class="fill-green">GREEN</span>, then it's required.</p>

    <form action="add.php" method="post">
        <table>
            <tr>
                <td>
                    <label class="simple-label" for="name">Team Name:</label>
                </td>
                <td><input required type="text" id="name" name="name"></td>
            </tr>
            <tr>
                <td>
                    <label class="simple-label" for="skillLevel">Skill Level (1-5):</label>
                </td>
                <td><input required id="skillLevel" type="number" min="1" max="5" name="skillLevel">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="simple-label" for="gameDay">Game Day:</label>
                </td>
                <td><select name="gameDay" id="gameDay">
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday"> Thursday</option>
                        <option value="Friday">Friday</option>
                    </select></td>
            </tr>
        </table>
        <br>
        <input id="submit" type="submit">
    </form>
</main>
<br>
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