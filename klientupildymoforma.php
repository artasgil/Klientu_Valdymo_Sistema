<?php
require_once("connection.php");
?>
 <?php
    if (isset($_GET["prideti"])) {
        if (isset($_GET["vardas"]) && !empty($_GET["vardas"]) && isset($_GET["pavarde"]) && !empty($_GET["pavarde"]) && isset($_GET["teises_id"]) && !empty($_GET["teises_id"])) {
            $vardas = $_GET["vardas"];
            $pavarde = $_GET["pavarde"];
            $teises_id = $_GET["teises_id"];

            if ($teises_id == is_numeric($teises_id) && $teises_id > 0) {
                $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`) VALUES ('$vardas','$pavarde ', $teises_id)";
                if (mysqli_query($prisijungimas, $sql)) {
                    $zinutegerai = "Irasas yra pridetas, jūs pridėjote naują klientą: " . $vardas . " " . $pavarde . " " . $teises_id;
                } else {
                    $zinuteblogai = "Kažkas ivyko negerai";
                }
            } else {
                $zinuteblogai = "Teisės ID nėra skaičius arba yra su minuso ženklu";
            }
        }
    } ?>

    <?php
    if (isset($_GET["papildyti"])) {
        for ($i = 1; $i < 201; $i++) {
            $randomid = (rand(1, 10));
            $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`,`teises_id`) VALUES ('vardas$i','pavarde$i', '$randomid')";
            mysqli_query($prisijungimas, $sql);
        }
        $zinutegerai = "Irasai buvo pridėti";
    }
    ?>

    <?php
    if (isset($_GET["parodyti"])) {
        header("location:klientai.php");
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientų pildymo forma</title>
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
    <div class="container">
        <h1>Klientų pildymo forma</h1>
        <form action="klientupildymoforma.php" method="get">
            <div class="form-group">
                <label for="vardas">Norėdami pridėti, įveskite vardą:</label>
                <input class="form-control" type="text" value="Vardas pridėjimui" name="vardas" />
            </div>
            <div class="form-group">
                <label for="pavarde">Norėdami pridėti, įveskite pavardę:</label>
                <input class="form-control" type="text" value="Pavardė pridėjimui" name="pavarde" />
            </div>
            <div class="form-group">
                <label for="teises_id">Norėdami pridėti, įveskite vartotojo teises:</label>
                <input class="form-control" type="text" value="1" name="teises_id" />
            </div>
            <button class="btn btn-primary" type="submit" name="prideti">Pridėti naują klientą</button>
            <button class="btn btn-primary" type="submit" name="papildyti">Papildyti duomenis 200 kartų iš karto</button>
            <button class="btn btn-primary" type="submit" name="parodyti">Parodyti visus duomenis</button>
            <?php if (isset($zinuteblogai)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $zinuteblogai; ?>
                </div>
            <?php } ?>
            <?php if (isset($zinutegerai)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $zinutegerai; ?>
                </div>
            <?php } ?>
        </form>
    </div>

   
</body>

</html>