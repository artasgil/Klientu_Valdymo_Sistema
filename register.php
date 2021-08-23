<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <?php require_once("include.php"); ?>
    
    <style>
        h1 {
            text-align: center;
        }

        .container {
            position:absolute;
            top:50%;
            left:50%;
            transform: translateY(-50%) translateX(-50%);
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
       $registracijos_data= date('Y-m-d');

    

       $sql = "SELECT * FROM `vartotojai` WHERE slapyvardis='$username' ";
       $result = $prisijungimas->query($sql);


       $class= "danger";
       if($result->num_rows == 1) {
           $message = "Toks vartotojas duomenu bazėje jau yra";
       } else {
          if($password==$repeat_password){
            
            $sql = "INSERT INTO `vartotojai`( `vardas`, `pavarde`, `slapyvardis`, `teises_ID`, `slaptazodis`, `registracijos_data`, `paskutinis_prisijungimas`) 
            VALUES ('$name','$surname','$username','$password',1,'$registracijos_data', '$registracijos_data')";    

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
        <h1>Registracija</h1>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" required="true" value="<?php 
                    if(isset($name)) {
                        echo $name;
                    } else {
                        echo "";
                    }
                ?>" />
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input class="form-control" type="text" name="surname" required="true" value="<?php 
                    if(isset($surname)) {
                        echo $surname;
                    } else {
                        echo "";
                    }
                ?>"/>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" required="true" value="<?php 
                    if(isset($username)) {
                        echo $username;
                    } else {
                        echo "";
                    }
                ?>"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" required="true" />
            </div>
            <div class="form-group">
                <label for="repeat-password">Repeat Password</label>
                <input class="form-control" type="password" name="repeat-password" required="true" />
            </div>


            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <a href="prisijungimas.php">Login here</a><br>
            <button class="btn btn-primary" type="submit" name="submit">Register</button>
        </form>
    </div>
</body>
</html>