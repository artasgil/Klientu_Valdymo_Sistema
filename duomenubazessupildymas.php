<?php 
require_once("connection.php");
for($i=1; $i<30; $i++) {
    $randomid = rand(1,3);
    $sql = "INSERT INTO `imones`(`pavadinimas`, `tipas_id`,`aprasymas`) VALUES ('imone$i','$randomid', 'imonesAprasymas$i')";
    mysqli_query($prisijungimas, $sql);

}
if(mysqli_query($prisijungimas, $sql)) {
    echo "Irasai yra prideti";
} else{
    echo "Kazkas ivyko negerai";
}
mysqli_close($prisijungimas);
?>