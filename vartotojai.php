<?php
require_once("connection.php");

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $prisijungimas->query("DELETE FROM `vartotojai` WHERE `ID` = $id");
    header("Location:vartotojai.php");
}

$sql = "SELECT * FROM `vartotojai` WHERE 1;";
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
        <h1>Vartotojų redagavimo arba ištrynimo forma</h1>
        <form action="vartotojai.php" method="get">
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Slapyvardis</th>
                        <th>Registracijos data</th>
                        <th>Paskutinis prisijungimas</th>
                        <th>Teisės ID</th>
                        <th colspan="2">Veiksmas</th>
                    </thead>
                    <?php while ($vartotojai = mysqli_fetch_array($rezultatas)) { ?>
                        <tr>
                            <td><?php echo $vartotojai["ID"]; ?></td>
                            <td><?php echo $vartotojai["vardas"]; ?></td>
                            <td><?php echo $vartotojai["pavarde"]; ?></td>
                            <td><?php echo $vartotojai["slapyvardis"]; ?></td>
                            <td><?php echo $vartotojai["registracijos_data"]; ?></td>
                            <td><?php echo $vartotojai["paskutinis_prisijungimas"]; ?></td>


                            <?php $teises_id = $vartotojai["teises_ID"];
                            $sql = "SELECT * FROM vartotojai_teises WHERE reiksme = $teises_id";
                            $result_teises = $prisijungimas->query($sql);

                            if ($result_teises->num_rows == 1) {
                                $rights = mysqli_fetch_array($result_teises);
                                echo "<td>";
                                echo $rights["aprasymas"];
                                echo "</td>";
                            } else {
                                echo "<td>Nepatvirtintas klientas</td>";
                            } ?>
                            </td>
                            <td><?php echo "<a href='vartotojaiEdit.php?edit=" . $vartotojai["ID"] . "'>Redaguoti</a>"; ?></td>
                            <td><?php echo "<a href='vartotojai.php?delete=" . $vartotojai["ID"] . "'>Istrinti</a>"; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
    </div>
    </form>
</body>

</html>