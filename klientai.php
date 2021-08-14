<?php
require_once("connection.php");

$vardas = "";
$pavarde = "";
$teises = "";
$teises_id = 0;
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $prisijungimas->query("DELETE FROM `klientai` WHERE `ID` = $id");
    header("Location:klientai.php");
}

if(isset($_GET["edit"])){
        $id= $_GET["edit"];
        $rezultatas = $prisijungimas->query ("SELECT * FROM `klientai` WHERE `ID` = $id");

            $klientai = $rezultatas->fetch_array();
            $vardas = $klientai['vardas'];
            $pavarde = $klientai['pavarde'];
            $teises_id = $klientai['teises_id'];
}

if (isset($_GET["atnaujinti"])) {
$id = $_GET["id"];
$vardas= $_GET["vardas"];
$pavarde=$_GET["pavarde"];
$teises=$_GET["teises"];
$prisijungimas->query ("UPDATE `klientai` SET `vardas`='$vardas',`pavarde`='$pavarde',`teises_id`='$teises' WHERE `ID` = $id");
header("Location:Klientai.php");
}




$sql = "SELECT * FROM `klientai` WHERE 1;"; //Tekstas
$rezultatas = $prisijungimas->query($sql); //Vykdo uzklausa

while ($klientai = mysqli_fetch_array($rezultatas)) {

    echo $klientai["ID"];
    echo " ";
    echo $klientai["vardas"];
    echo " ";
    echo $klientai["pavarde"];
    echo " ";
    echo $klientai["teises_id"];
    echo " ";
    echo "<a href='klientai.php?edit=" . $klientai["ID"] . "'>Redaguoti</a>";
    echo " ";
    echo "<a href='klientai.php?delete=" . $klientai["ID"] . "'>Istrinti</a>";
    echo "<br>";
}



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
<form action="klientai.php" method="get">
    <input type = "hidden" name="id" value = "<?php echo $id?>" />
        <input type="text" value="<?php echo $vardas ?>" name="vardas" />
        <input type="text" value="<?php echo $pavarde ?>" name="pavarde" />
        <input type="text" value="<?php echo $teises_id ?>" name="teises" />
        <button type="submit" name="atnaujinti">Atnaujinti</button>
    </form>
</body>
</html>