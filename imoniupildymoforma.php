<?php
require_once("connection.php");
?>
<?php
if (isset($_GET["prideti"])) {
    if (isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"]) && isset($_GET["aprasymas"]) && !empty($_GET["aprasymas"]) && isset($_GET["tipas_id"]) && !empty($_GET["tipas_id"])) {
        $pavadinimas = $_GET["pavadinimas"];
        $aprasymas = $_GET["aprasymas"];
        $tipas_id = intval($_GET["tipas_id"]);


        if ($tipas_id == is_numeric($tipas_id) && $tipas_id > 0) {
            $sql = "INSERT INTO `imones`(`pavadinimas`, `tipas_id`, `aprasymas`) 
            VALUES ('$pavadinimas','$tipas_id ','$aprasymas')";
            if (mysqli_query($prisijungimas, $sql)) {
                $zinutegerai = "Įrašas pridėtas, jūs pridėjote naują įmonę: " . $pavadinimas . " " . $aprasymas;
            } else {
                $zinuteblogai = "Kažkas ivyko negerai";
            }
        } else {
            $zinuteblogai = "Teisės ID nėra skaičius arba yra su minuso ženklu";
        }
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Įmonių pildymo forma</title>
    <?php require_once("include.php"); ?>

    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php require_once("includes/menu.php"); ?>
        <?php if ($row["reiksme"] == 1 || $row["reiksme"] == 2 || $row["reiksme"] == 4) { ?>
            <h1>Įmonių pildymo forma</h1>
            <form action="imoniupildymoforma.php" method="get">
                <div class="form-group">
                    <label for="pavadinimas">Norėdami pridėti, įveskite įmonės pavadinimą:</label>
                    <input class="form-control" type="text" value="Pavadinimas pridėjimui" name="pavadinimas" />
                </div>
                <div class="form-group">
                    <label for="aprasymas">Norėdami pridėti, įveskite įmonės aprašymą:</label>
                    <input class="form-control" type="text" value="Aprašymas pridėjimui" name="aprasymas" />
                </div>
                <div class="form-group">
                    <label for="teises_id">Pasirinkite įmonės tipą:</label>
                    <select class="form-control" name="tipas_id">
                        <?php
                        $sql = "SELECT * FROM imones_tipas";
                        $result = $prisijungimas->query($sql);
                        while ($imonesTipas = mysqli_fetch_array($result)) {
                            echo "<option value='" . $imonesTipas["reiksme"] . "'>";
                            echo $imonesTipas["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit" name="prideti">Pridėti naują klientą</button>

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
<?php } ?>

</body>

</html>