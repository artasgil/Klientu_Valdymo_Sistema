<?php
        if (isset($_GET["patvirtinti"])) {
            $pasirinkimas = $_GET["pasirinkimas"];
            // $sql = "INSERT INTO `registracija` (`ijungimas_isjungimas`) VALUES ('$pasirinkimas')";
            $sql = "UPDATE `registracija` SET `ijungimas_isjungimas`='$pasirinkimas' WHERE `ID`=1";
            $registracija_teises = $prisijungimas->query($sql);
        }
        $sql = "SELECT * FROM registracija WHERE ijungimas_isjungimas=1";
        $registracija_teises = $prisijungimas->query($sql);
        if ($registracija_teises->num_rows == 1 && $registracija_teises == $registracija_teises) {
            $registracija = mysqli_fetch_assoc($registracija_teises);
            echo "Registracijos galimybė: įjungta";
        } else {
            $registracija = 2;
            echo "Registracijos galimybė: išjungta";
        }
?>