<?php
require_once("connection.php");
$pavadinimas = "";
$aprasymas = "";
$tipas_id = "";
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $rezultatas = $prisijungimas->query("SELECT * FROM `imones` WHERE `ID` = $id");

    $imones = $rezultatas->fetch_array();
    $pavadinimas = $imones['pavadinimas'];
    $aprasymas = $imones['aprasymas'];
    $tipas_id = $imones['tipas_id'];
}

if (isset($_GET["atnaujinti"])) {
    $id = $_GET["id"];
    $pavadinimas = $_GET["pavadinimas"];
    $aprasymas = $_GET["aprasymas"];
    $tipas_id = $_GET["tipas_id"];

    $prisijungimas->query("UPDATE `imones` SET `pavadinimas`='$pavadinimas',`tipas_id`='$tipas_id',`aprasymas`='$aprasymas' WHERE `ID` = $id");
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
    <title>Imonių redagavimo forma</title>
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
    <?php if($row["reiksme"]==1 || $row["reiksme"]==2 || $row["reiksme"]== 4) { ?>
        <h1>Imonių redagavimo forma</h1>
        <form action="imonesEdit.php" method="get">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <div class="form-group">
                <label for="pavadinimas">Pavadinimas</label>
                <input class="form-control" type="text" value="<?php echo $pavadinimas ?>" name="pavadinimas" />
            </div>
            <div class="form-group">
                <label for="aprasymas">Aprašymas</label>
                <textarea class="form-control" type="text" name="aprasymas"><?php echo $aprasymas ?></textarea>
            </div>
            <div class="form-group">
                <label for="tipas_id">Įmonės tipas</label>
                <select class="form-control" name="tipas_id">
                    <?php
                    $sql = "SELECT * FROM imones_tipas";
                    $result = $prisijungimas->query($sql);
                    while ($imonesTipas = mysqli_fetch_array($result)) {

                        if ($imones["tipas_id"] == $imonesTipas["reiksme"]) {
                            echo "<option value='" . $imonesTipas["reiksme"] . "' selected='true'>";
                        } else {
                            echo "<option value='" . $imonesTipas["reiksme"] . "'>";
                        }

                        echo $imonesTipas["pavadinimas"];
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit" name="atnaujinti">Atnaujinti</button>
            <button class="btn btn-primary" type="submit" name="grizti">Grįžti atgal į klientų pridėjimą</button>
    </div>

    </form>
</body>
<?php } ?>
</html>