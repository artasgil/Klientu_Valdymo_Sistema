<?php

//1. Turime prisijungti prie duomenu bazes
//2. Atlikti tam tikras uzklausas(SELECT, UPDATE, DELETE, INSERT)
//3. Uzdaryti prisijungimas



//1. Prisijungimas

require_once("connection.php");
//connection.php faile kodas yra pasiekiamas index.php faile


//Read - SELECT operacija
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
    echo "<br>";



}
// $klientai = mysqli_fetch_array($rezultatas); //is uzklausos paimk rezultatus ir juo sudek i masyva


//Uzdaryti duomenu baze

//Create - INSERT

$sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`) VALUES ('IdetsasNaujasVardas','IdetaNaujaPavarde', 2)";

if(mysqli_query($prisijungimas, $sql)) {
    echo "Irasas yra pridetas";
} else{
    echo "Kazkas ivyko negerai";
}

echo "<br>";

//Update - UPDATE
$sql = "UPDATE `klientai` SET `vardas`='PakeistasTikVardas' WHERE ID=10";

if(mysqli_query($prisijungimas, $sql)) {
    echo "Irasas yra pridetas";
} else{
    echo "Kazkas ivyko negerai";
}

echo "<br>";

//Delte - DELETE
$sql = "DELETE FROM `klientai` WHERE ID=7";

if(mysqli_query($prisijungimas, $sql)) {
    echo "Irasas yra pakeistas";
} else{
    echo "Kazkas ivyko negerai";
}

mysqli_close($prisijungimas);



?>
