<?php 
require_once("connection.php");
for($i=1; $i<201; $i++) {
    $randomid = (rand(1,10));
    $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`,`teises_id`) VALUES ('vardas$i','pavarde$i', '$randomid')";
    if(mysqli_query($prisijungimas, $sql)) {
        echo "Irasas yra pridetas";
    } else{
        echo "Kazkas ivyko negerai";
    }
}

?>