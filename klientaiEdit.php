<?php
require_once("connection.php");
$vardas = "";
$pavarde = "";
$teises = "";
$teises_id = "";
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

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateY(-50%) translateX(-50%);
        }

        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Klientų redagavimo arba ištrynimo forma</h1>
        <form action="klientaiEdit.php" method="get">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <div class="form-group">
                <label for="vardas">Vardas</label>
                <input class="form-control" type="text" value="<?php echo $vardas ?>" name="vardas" />
            </div>
            <div class="form-group">
                <label for="vardas">Pavarde</label>
                <input class="form-control" type="text" value="<?php echo $pavarde ?>" name="pavarde" />
            </div>
                <div class="form-group">
                    <label for="teises_id">Teisės</label>
                    <select class="form-control" name="teises">
                        <?php
                        $sql = "SELECT * FROM klientai_teises";
                        $result = $prisijungimas->query($sql);
                        while ($clientRights = mysqli_fetch_array($result)) {

                            if ($klientai["teises_id"] == $clientRights["reiksme"]) {
                                echo "<option value='" . $clientRights["reiksme"] ."' selected='true'>";
                            } else {
                                echo "<option value='" . $clientRights["reiksme"] . "'>";
                            }

                            echo $clientRights["pavadinimas"];
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

</html>