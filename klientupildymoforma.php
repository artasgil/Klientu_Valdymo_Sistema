<?php 
require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="klientupildymoforma.php" method="get">
        <input type="text" value="TestasVardas" name="vardas" />
        <input type="text" value="TestasPavarde" name="pavarde" />
        <input type="text" value="5" name="teises_id" />
        <button type="submit" name="papildyti">Papildyti duomenis 200 kartu</button>
        <button type="submit" name="parodyti">Parodyti visus duomenis</button>
        <button type="submit" name="prideti">Pridėti naują klientą</button>
    </form>

    <?php
    if (isset($_GET["prideti"])) {
        if (isset($_GET["vardas"]) && !empty($_GET["vardas"]) && isset($_GET["pavarde"]) && !empty($_GET["pavarde"]) && isset($_GET["teises_id"]) && !empty($_GET["teises_id"])) {
           $vardas = $_GET["vardas"];
           $pavarde = $_GET["pavarde"];
           $teises_id = $_GET["teises_id"];

           if ($teises_id==is_numeric($teises_id) && $teises_id > 0) {
            $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`) VALUES ('$vardas','$pavarde ', $teises_id)";
            if (mysqli_query($prisijungimas, $sql)) {
                echo "Irasas yra pridetas, jūs pridėjote naują klientą: ".$vardas. " ".$pavarde. " ".$teises_id;
            } else {
                echo "Kazkas ivyko negerai";
            }
        } else {
            echo "Teisės ID nėra skaičius arba yra minusinis";
        }
        }
    } ?>

    <?php 
        if (isset($_GET["papildyti"])) {
            for($i=1; $i<201; $i++) {
                $randomid = (rand(1,10));
                $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`,`teises_id`) VALUES ('vardas$i','pavarde$i', '$randomid')";
                if(mysqli_query($prisijungimas, $sql)) {
                    echo "Irasai yra prideti";
                } else{
                    echo "Kazkas ivyko negerai";
                }
            }
        }
            
    ?>

    <?php 
        if (isset($_GET["parodyti"])) {
            header("location:klientai.php");
        }
    ?>
</body>

</html>