

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
    <?php require_once("includes/menu.php"); ?>
    <?php if($row["reiksme"]==1 || $row["reiksme"]==3 || $row["reiksme"]==4 ) { ?>
        <h1>Vartotojų redagavimo arba ištrynimo forma</h1>
        <form action="vartotojai.php" method="get">
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Slapyvardis</th>
                        <?php if($row["reiksme"]==1) { ?> 
                        <th>Registracijos data</th>
                        <?php } ?>
                        <th>Paskutinis prisijungimas</th>
                        <?php if($row["reiksme"]==1) { ?>
                         <th>Teisės ID</th>
                         <?php } ?>
                        <th colspan="2">Veiksmas</th>

                    </thead>
                    <?php while ($vartotojai = mysqli_fetch_array($rezultatas)) { ?>
                        <tr>
                            <td><?php echo $vartotojai["ID"]; ?></td>
                            <td><?php echo $vartotojai["vardas"]; ?></td>
                            <td><?php echo $vartotojai["pavarde"]; ?></td>
                            <td><?php echo $vartotojai["slapyvardis"]; ?></td>
                            <?php if($row["reiksme"]==1) { ?> 
                            <td><?php echo $vartotojai["registracijos_data"]; ?></td>
                            <?php } ?>
                            <td><?php echo $vartotojai["paskutinis_prisijungimas"]; ?></td>

                            <?php if($row["reiksme"]==1) { ?>
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
                            <?php } ?>
                            <?php if($row["reiksme"]==4 || $row["reiksme"]==1) { ?>
                            <td><?php echo "<a href='vartotojai.php?delete=" . $vartotojai["ID"] . "'>Istrinti</a>"; ?></td>
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