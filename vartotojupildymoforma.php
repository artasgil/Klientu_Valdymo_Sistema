<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naujų vartotojų pridėjimas</title>

    <?php require_once("include.php"); ?>
    
    <style>
        h1 {
            text-align: center;
        }
    
    </style>

</head>
<body>


<?php 
    if(isset($_POST["submit"])) { 
           
       $name =$_POST["name"];
       $surname =$_POST["surname"];
       $username =$_POST["username"];
       $password =$_POST["password"];
       $repeat_password = $_POST["repeat-password"];
       $teises_id = intval($_POST["teises_id"]);
       $registracijos_data= date('Y-m-d');
    

       $sql = "SELECT * FROM `vartotojai` WHERE slapyvardis='$username' ";
       $result = $prisijungimas->query($sql);


       $class= "danger";
       if($result->num_rows == 1) {
           $message = "Toks vartotojas duomenu bazėje jau yra";
       } else {
          if($password==$repeat_password){
            
            $sql = "INSERT INTO `vartotojai`( `vardas`, `pavarde`, `slapyvardis`, `teises_ID`, `slaptazodis`, `registracijos_data`) 
            VALUES ('$name','$surname','$username','$teises_id','$password','$registracijos_data')";    

            if(mysqli_query($prisijungimas, $sql)) {
                $class= "success";
                $message = "Vartotojas sukurtas sekmingai";
            } else {
                $message = "Kazkas ivyko negerai";
            }

          } else {
            $message = "Slaptažodžiai nesutampa";
          }
       }

    }
?>
<div class="container">
<?php require_once("includes/menu.php"); ?>

<?php if($row["reiksme"]==1 || $row["reiksme"]==4) { ?>
    <h1>Naujų vartotojų pridėjimas</h1>
        <form action="vartotojupildymoforma.php" method="post">
            <div class="form-group">
                <label for="name">Naujo vartotojo vardas</label>
                <input class="form-control" type="text" name="name" required="true" value="<?php 
                    if(isset($name)) {
                        echo $name;
                    } else {
                        echo "";
                    }
                ?>" />
            </div>
            <div class="form-group">
                <label for="surname">Naujo vartotojo pavardė</label>
                <input class="form-control" type="text" name="surname" required="true" value="<?php 
                    if(isset($surname)) {
                        echo $surname;
                    } else {
                        echo "";
                    }
                ?>"/>
            <div class="form-group">
                <label for="username">Naujo vartotojo slapyvardis</label>
                <input class="form-control" type="text" name="username" required="true" value="<?php 
                    if(isset($username)) {
                        echo $username;
                    } else {
                        echo "";
                    }
                ?>"/>
            </div>
            <div class="form-group">
                <label for="password">Naujo vartotojo slaptažodis</label>
                <input class="form-control" type="password" name="password" required="true" />
            </div>
            <div class="form-group">
                <label for="repeat-password">Naujo vartotojo pakartotinis slaptažodis</label>
                <input class="form-control" type="password" name="repeat-password" required="true" />
            </div>
            <div class="form-group">
                <label for="teises_id">Nustatykite vartotojo teises:</label>
                <select class="form-control" name="teises_id">
                    <?php
                    $sql = "SELECT * FROM vartotojai_teises";
                    $result = $prisijungimas->query($sql);
                    while ($vartotojaiRights = mysqli_fetch_array($result)) {
                        echo "<option value='" . $vartotojaiRights["reiksme"] . "'>";
                        echo $vartotojaiRights["aprasymas"];
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>


            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <button class="btn btn-primary" type="submit" name="submit">Registruoti</button>
        </form>
    </div>
    <?php } ?>
</body>
</html>