<?php
require_once("connection.php");
?>
<?php
if (isset($_GET["prideti"])) {
    if (isset($_GET["vardas"]) && !empty($_GET["vardas"]) && isset($_GET["pavarde"]) && !empty($_GET["pavarde"]) && isset($_GET["teises_id"]) && !empty($_GET["teises_id"])) {
        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = intval($_GET["teises_id"]);
        $pridejimo_data = date('Y-m-d');


        if ($teises_id == is_numeric($teises_id)) {
            $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`, `pridejimo_data`)
           VALUES ('$vardas','$pavarde ', '$teises_id', '$pridejimo_data')";
            if (mysqli_query($prisijungimas, $sql)) {
                $zinutegerai = "Įrašas pridėtas, jūs pridėjote naują klientą: " . $vardas . " " . $pavarde . " " . $teises_id;
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
        $randomid = rand(1, 5);
        $pridejimo_data = date('Y-m-d');
        $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`,`teises_id`, `pridejimo_data`) VALUES ('vardas$i','pavarde$i', '$randomid', '$pridejimo_data')";
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

    </style>
</head>

<body>
    <div class="container">
    <?php require_once("includes/menu.php"); ?>
    <?php if($row["reiksme"]==1 || $row["reiksme"]==2 || $row["reiksme"]== 4) { ?>
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
                <label for="teises_id">Teisės:</label>
                <select class="form-control" name="teises_id">
                    <?php
                    $sql = "SELECT * FROM klientai_teises";
                    $result = $prisijungimas->query($sql);
                    while ($clientRights = mysqli_fetch_array($result)) {
                        echo "<option value='" . $clientRights["reiksme"] . "'>";
                        echo $clientRights["pavadinimas"];
                        echo "</option>";
                    }
                    ?>
                </select>
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
<?php } ?>

</body>

</html>