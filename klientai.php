<?php
require_once("connection.php");

$vardas = "";
$pavarde = "";
$teises = "";
$teises_id = "";
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $prisijungimas->query("DELETE FROM `klientai` WHERE `ID` = $id");
    header("Location:klientai.php");
}

if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $rezultatas = $prisijungimas->query("SELECT * FROM `klientai` WHERE `ID` = $id");

    $klientai = $rezultatas->fetch_array();
    $vardas = $klientai['vardas'];
    $pavarde = $klientai['pavarde'];
    $teises_id = $klientai['teises_id'];
}

if (isset($_GET["atnaujinti"])) {
    $id = $_GET["id"];
    $vardas = $_GET["vardas"];
    $pavarde = $_GET["pavarde"];
    $teises = $_GET["teises"];
    
    $prisijungimas->query("UPDATE `klientai` SET `vardas`='$vardas',`pavarde`='$pavarde',`teises_id`='$teises' WHERE `ID` = $id");

}

if (isset($_GET["grizti"])) {
    header("Location: klientupildymoforma.php");
}


$sql = "SELECT * FROM `klientai` WHERE 1;";
$rezultatas = $prisijungimas->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientų redagavimo forma</title>
    <?php require_once("include.php"); ?>
    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Klientų redagavimo arba ištrynimo forma</h1>
        <form action="klientai.php" method="get">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <div class="form-group">
                <input type="text" value="<?php echo $vardas ?>" name="vardas" />
                <input type="text" value="<?php echo $pavarde ?>" name="pavarde" />
                <input type="text" value="<?php echo $teises_id ?>" name="teises" />
                <button class="btn btn-primary" type="submit" name="atnaujinti">Atnaujinti</button>
                <button class="btn btn-primary" type="submit" name="grizti">Grįžti atgal į klientų pridėjimą</button>
            </div>
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Teisės ID</th>
                        <th colspan="2">Veiksmas</th>

                    </thead>
                    <?php while ($klientai = mysqli_fetch_array($rezultatas)) { ?>
                        <tr>
                            <td><?php echo $klientai["ID"]; ?></td>
                            <td><?php echo $klientai["vardas"]; ?></td>
                            <td><?php echo $klientai["pavarde"]; ?></td>
                            <td><?php echo $klientai["teises_id"]; ?></td>
                            <td><?php echo "<a href='klientai.php?edit=" . $klientai["ID"] . "'>Redaguoti</a>"; ?></td>
                            <td><?php echo "<a href='klientai.php?delete=" . $klientai["ID"] . "'>Istrinti</a>"; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
    </div>
    </form>
</body>

</html>