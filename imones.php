<?php
require_once("connection.php");

$pavadinimas = "";
$aprasymas = "";
$tipas_id = "";

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $prisijungimas->query("DELETE FROM `imones` WHERE `ID` = $id");
    header("Location:imones.php");
}

$sql = "SELECT * FROM `imones` WHERE 1;";
$rezultatas = $prisijungimas->query($sql);
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
    </style>
</head>

<body>
    <div class="container">
    <?php require_once("includes/menu.php"); ?>
        <h1>Imonių redagavimo arba ištrynimo forma</h1>
        <form action="imones.php" method="get">
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Pavadinimas</th>
                        <th>Aprašymas</th>
                        <th>Tipas ir tipo aprašymas</th>
                        <th colspan="2">Veiksmas</th>
                    </thead>
                    <?php while ($imones = mysqli_fetch_array($rezultatas)) { ?>
                        <tr>
                            <td><?php echo $imones["ID"]; ?></td>
                            <td><?php echo $imones["pavadinimas"]; ?></td>
                            <td><?php echo $imones["aprasymas"]; ?></td>

                            <?php $tipas_id = $imones["tipas_id"];
                            $sql = "SELECT * FROM imones_tipas WHERE reiksme = $tipas_id";
                            $result_tipas = $prisijungimas->query($sql); //vykdoma uzklausa

                            if ($result_tipas->num_rows == 1) {
                                $tipas = mysqli_fetch_array($result_tipas);
                                echo "<td>";
                                echo $tipas["pavadinimas"]." ". $tipas["aprasymas"];
                                echo "</td>";
                            } else {
                                echo "<td>Nepatvirtintas klientas</td>";
                            } ?>
                            </td>
                            <td><?php echo "<a href='imonesEdit.php?edit=" . $imones["ID"] . "'>Redaguoti</a>"; ?></td>
                            <td><?php echo "<a href='imones.php?delete=" . $imones["ID"] . "'>Istrinti</a>"; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
    </div>
    </form>
</body>

</html>