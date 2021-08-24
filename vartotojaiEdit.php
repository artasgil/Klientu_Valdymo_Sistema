<?php
require_once("connection.php");

if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $rezultatas = $prisijungimas->query("SELECT * FROM `vartotojai` WHERE `ID` = $id");

    $vartotojai = $rezultatas->fetch_array();
    $vardas = $vartotojai['vardas'];
    $pavarde = $vartotojai['pavarde'];
    $slapyvardis = $vartotojai['slapyvardis'];
    $teises_id = $vartotojai['teises_ID'];
}

if (isset($_GET["atnaujinti"])) {
    $id = $_GET["id"];
    $vardas = $_GET["vardas"];
    $pavarde = $_GET["pavarde"];
    $slapyvardis = $_GET["slapyvardis"];
    $teises_id = $_GET["teises_id"];


    $prisijungimas->query("UPDATE `vartotojai` SET `vardas`='$vardas',`pavarde`='$pavarde',`slapyvardis`='$slapyvardis',`teises_ID`='$teises_id' WHERE `ID` = $id");
}

if (isset($_GET["grizti"])) {
    header("Location: klientupildymoforma.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vartotojų redagavimo forma</title>
    <?php require_once("include.php"); ?>
    <style>
        h1 {
            text-align: center;
        }

        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
    <?php require_once("includes/menu.php"); ?>
    <?php if($row["reiksme"]==1) { ?>
        <h1>Vartotojų redagavimo forma</h1>
        <form action="vartotojaiEdit.php" method="get">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <div class="form-group">
                <label for="vardas">Vardas</label>
                <input class="form-control" type="text" value="<?php echo $vardas ?>" name="vardas" />
            </div>
            <div class="form-group">
                <label for="pavarde">Pavardė</label>
                <input class="form-control" type="text" value="<?php echo $pavarde ?>" name="pavarde" />
            </div>
            <div class="form-group">
                <label for="slapyvardis">Slapyvardis</label>
                <input class="form-control" type="text" value="<?php echo $slapyvardis ?>" name="slapyvardis" />
            </div>
            <div class="form-group">
                <label for="tipas_id">Vartotojų teisės</label>
                <select class="form-control" name="teises_id">
                    <?php
                    $sql = "SELECT * FROM vartotojai_teises";
                    $result = $prisijungimas->query($sql);
                    while ($vartotojaiTeises = mysqli_fetch_array($result)) {

                        if ($vartotojai["teises_ID"] == $vartotojaiTeises["reiksme"]) {
                            echo "<option value='" . $vartotojaiTeises["reiksme"] . "' selected='true'>";
                        } else {
                            echo "<option value='" . $vartotojaiTeises["reiksme"] . "'>";
                        }

                        echo $vartotojaiTeises["pavadinimas"];
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit" name="atnaujinti">Atnaujinti</button>
            <button class="btn btn-primary" type="submit" name="grizti">Grįžti atgal į klientų pridėjimą</button>
    </div>

    </form>
    <?php } ?>

</body>

</html>