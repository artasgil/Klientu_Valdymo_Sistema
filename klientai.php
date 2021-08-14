<?php
require_once("connection.php");

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
                echo "<a href='klientai.php?edit=".$klientai["ID"]."'>Redaguoti</a>";
                echo " ";
                echo "<a href='klientai.php?delete=".$klientai["ID"]."'>Istrinti</a>";
                echo "<br>";
            }
            
            if(isset($_GET["delete"])){
                $id= $_GET["delete"];
                $prisijungimas->query ("DELETE FROM `klientai` WHERE `ID` = $id;");
            }

            if(isset($_GET["edit"])){
                $id= $_GET["edit"];
                $rezultatas = $prisijungimas->query ("DELETE FROM `klientai` WHERE `ID` = $id;");
                header("location:klientai.php");

                if(count($rezul))
            }

            ?>
