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
    <?php require_once("includes/menu.php"); ?>
    <?php if($row["reiksme"]==1 || $row["reiksme"]==2 || $row["reiksme"]==3 || $row["reiksme"]== 4) { ?>
        <h1>Klientų redagavimo arba ištrynimo forma</h1>
        <form action="klientai.php" method="get">
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Pridėjimo data</th>
                        <th>Teisės ID</th>
                        <th colspan="2">Veiksmas</th>
                     
                    </thead>
                    <?php while ($klientai = mysqli_fetch_array($rezultatas)) { ?>
                        <tr>
                            <td><?php echo $klientai["ID"]; ?></td>
                            <td><?php echo $klientai["vardas"]; ?></td>
                            <td><?php echo $klientai["pavarde"]; ?></td>
                            <td><?php echo $klientai["pridejimo_data"]; ?></td>
                            <?php $teises_id = $klientai["teises_id"];
                            $sql = "SELECT * FROM klientai_teises WHERE reiksme = $teises_id";
                            $result_teises = $prisijungimas->query($sql);

                            if ($result_teises->num_rows == 1) {
                                $rights = mysqli_fetch_array($result_teises);
                                echo "<td>";
                                echo $rights["pavadinimas"];
                                echo "</td>";
                            } else {
                                echo "<td>Nepatvirtintas klientas</td>";
                            } ?>
                            </td>
                            <?php if($row["reiksme"] !=3) { ?>
                            <td><?php echo "<a href='klientaiEdit.php?edit=" . $klientai["ID"] . "'>Redaguoti</a>"; ?></td>
                            <td><?php echo "<a href='klientai.php?delete=" . $klientai["ID"] . "'>Istrinti</a>"; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
    </div>
    </form>
    <?php } ?>
</body>

</html>