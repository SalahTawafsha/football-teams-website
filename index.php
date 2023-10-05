<!DOCTYPE html>
<html lang="en" class="center-form">

<head>
    <meta charset="UTF-8">
    <title>Kickball League</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.75">
    <link rel="stylesheet" href="teams/style.css">
</head>

<body>

<main class="center-form">
    <h1>Welcome!</h1>

    <?php
    session_start();

    if (isset($_SESSION["email"]))
        header("location: dashboard.php");

    // handle errors that from login_process.php
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
        if ($error == 1)
            echo "<h4 class='error'>password is too weak, it must be 8 or more character.</h4><br>";
        else if ($error == 2)
            echo "<h4 class='error'>Passwords doesn't match.</h4><br>";
        else if ($error == 3)
            echo "<h4 class='error'>Uncorrected Password.</h4><br>";
        else
            echo "<h4 class='error'>Account doesn't exist.</h4><br>";
    }

    // handle messages that from sign_up_process.php
    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        if ($msg == 1)
            echo "<h4>Account Added.</h4><br>";
        else
            echo "<h4 class='error'>Account is already exist.</h4><br>";
    }
    ?>


    <form action="register.php" method="post" class="center-form">
        <h3>Register</h3>
        <hr>
        <table>
            <tr>
                <td><label class="simple-label" for="signUpUserName">User Name:</label></td>
                <td><input class="simple-input" type="text" name="userName" id="signUpUserName" required></td>
            </tr>
            <tr>
                <td><label class="simple-label" for="signUpEmail">Email:</label></td>
                <td><input class="simple-input" type="email" name="email" id="signUpEmail" required></td>
            </tr>
            <tr>
                <td><label class="simple-label" for="signUpPassword">Password:</label></td>
                <td><input class="simple-input" type="password" name="password" id="signUpPassword" minlength="8" required></td>
            </tr>
            <tr>
                <td><label class="simple-label" for="signUpConfirmPassword">Confirm Password:</label></td>
                <td><input class="simple-input" type="password" name="confirmPassword" minlength="8" id="signUpConfirmPassword"
                           required></td>
            </tr>
        </table>
        <br>
        <input id="submit" type="submit" value="Register">
    </form>

    <br>

    <form action="login.php" method="post" class="center-form">
        <h3>Log in</h3>
        <hr>
        <table>
            <tr>
                <td>
                    <label class="simple-label" for="loginEmail">Email:</label>
                </td>
                <td><input class="simple-input" type="email" name="email" id="loginEmail" required></td>
            </tr>
            <tr>
                <td>
                    <label class="simple-label" for="loginPassword">Password:</label>
                </td>
                <td><input class="simple-input" type="password" minlength="8" name="password" id="loginPassword" required></td>
            </tr>
        </table>
        <br>
        <input id="submit" type="submit" value="Log in">
    </form>

</main>
</body>

</html>