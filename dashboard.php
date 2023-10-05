<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Kickball League Dashboard</title>
    <!--    <link rel="stylesheet" href="dashboard.css">-->
    <link rel="stylesheet" href="teams/style.css">
</head>

<body>
<header>
    <ul class="horizontal-items">
        <li>
                <ul class="horizontal-items">
                    <li><a href="dashboard.php">
                            <ul class="horizontal-items">
                                <li><img src="logo.png" alt="Site icon"></li>
                                <li>Dashboard</li>
                            </ul>
                        </a></li>
                    <li>
                    <li><a href="../index.html">My Profile</a></li>
                </ul>
        </li>
        <li><h3>Dashboard</h3></li>
        <li>
                <ul class="horizontal-items">
                    <li><a href="about.html">about us</a></li>
                    <li><a href="log_out.php">log out</a></li>
                </ul>
        </li>
    </ul>
</header>

    <nav>
        <ul>
            <li><a href="teams/new/index.php">Create New Team</a></li>
        </ul>
    </nav>
    <main>
        <h1>Welcome,
            <?php
            include_once "db_connect.inc";

            $connection = connect();

            session_start();


            if (!isset($_SESSION["email"]))
                header("location: index.php");

            $email = $_SESSION["email"];

            $sql = $connection->prepare("SELECT name FROM user WHERE email = :email;");

            $sql->bindParam(":email", $email);

            $sql->execute();

            $row = $sql->fetch();

            echo $row["name"];
            ?>
        </h1>

        <br>
        <p>Teams in <span class="fill-green">GREEN</span> is created by you and you can update it.</p>

        <table class="dashboardTable">
            <thead>
            <tr>
                <th>Team Name</th>
                <th>Skill Level (1-5)</th>
                <th>Players</th>
                <th>Game Day</th>
            </tr>
            </thead>

            <tbody>
            <?php


            $sql = $connection->prepare(
                "SELECT *, IF(email = :email, 'Yes', 'No') AS isMine FROM team order by name;");

            $sql->bindParam(":email", $email);

            $sql->execute();

            $row = $sql->fetchAll();


            foreach ($row as $value) {
                $teamName = $value["name"];
                $skillLevel = $value["skill_level"];
                $gameDay = $value["game_day"];

                $playersQuery = $connection->prepare("select count(*) AS 'count' from player where team_name  = :team_name;");

                $playersQuery->bindParam(":team_name", $teamName);

                $playersQuery->execute();

                $playersRow = $playersQuery->fetchAll();

                $playersCount = $playersRow[0]["count"];

                $isMine = $value["isMine"] == "Yes";
                echo "<tr>";
                if ($isMine) {
                    echo "<td><a class='isMine' href='teams/details/index.php?name=$teamName'>" . $teamName . "</a></td>";
                } else {
                    echo "<td><a class='notIsMine' href='teams/details/index.php?name=$teamName'>" . $teamName . "</a></td>";
                }
                echo "<td>" . $skillLevel . "</td>";
                echo "<td>" . $playersCount . "/9</td>";
                echo "<td>" . $gameDay . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <br>

        <a class="button" href="teams/new/index.php">Create New Team</a>

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