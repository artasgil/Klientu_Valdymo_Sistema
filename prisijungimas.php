<?php
require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisijungimas</title>
    <?php require_once("include.php"); ?>


    <style>
        h1 {
            text-align: center;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateY(-50%) translateX(-50%);
        }
    </style>
</head>

<body>

    <?php

    if (isset($_POST["submit"])) {
        if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM `vartotojai` WHERE slapyvardis = '$username' AND slaptazodis = '$password'";
            $result = $prisijungimas->query($sql);

            if ($result->num_rows == 1) {
                $user_info = mysqli_fetch_array($result);
                $cookie_array = array(
                    $user_info["ID"],
                    $user_info["slapyvardis"],
                    $user_info["vardas"],
                    $user_info["teises_ID"],
                );

                $cookie_array = implode("|", $cookie_array);
                setcookie("prisijungta", $cookie_array, time() + 3600, "/");
                header("Location: adminTeises.php");
                $sql = "UPDATE `vartotojai` SET `paskutinis_prisijungimas`= now() WHERE slapyvardis= '$username' AND slaptazodis='$password'";
                $resultatas = $prisijungimas->query($sql);
            } else {
                $message = "Neteisingi prisijungimo duomenys";
            }
        } else {
            $message = "Laukeliai yra tušti arba duomenys neteisingi";
        }
    }

    ?>
    <?php if (!isset($_COOKIE["prisijungta"])) { ?>
        <div class="container">
            <h1>Klientų valdymo sistema</h1>
            <form action="prisijungimas.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input class="form-control" type="text" name="username" />
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" />
                </div>
                <a href="register.php">Register here</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Log in</button>

            </form>
            <?php if (isset($message)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
        </div>
    <?php } else {
        header("Location: klientupildymoforma.php");
    } ?>

</body>

</html>