
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin valdymas</title>
    <?php require_once("include.php"); ?>
    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php require_once("includes/menu.php"); ?>
        <h1>Valdymas ir suteiktos teisės</h1>
        <?php if($row["reiksme"]==2) { ?>
        <form action="adminTeises.php" method="get">
        <button class="btn btn-primary" type="submit" name="vartotojuRedagavimas">Vartotojų redagavimas</button>
        <button class="btn btn-primary" type="submit" name="klientuRedagavimas">Klientų redagavimas</button>
        <button class="btn btn-primary" type="submit" name="imoniuRedagavimas">Įmonių redagavimas</button>
    </form>
   <?php } ?>
</body>

</html>