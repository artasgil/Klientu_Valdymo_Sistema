<?php
require_once("connection.php");
?>
<?php if (!isset($_COOKIE["prisijungta"])) {
    header("Location: prisijungimas.php");
} elseif (isset($_COOKIE["prisijungta"])) {
    $teises_id = explode("|", $_COOKIE["prisijungta"]);
    $sql = "SELECT * FROM vartotojai_teises WHERE reiksme = $teises_id[3]";
    $result_teises = $prisijungimas->query($sql);
    if ($result_teises->num_rows == 1 && $result_teises == $result_teises) {
        $row = mysqli_fetch_assoc($result_teises);
    } else {
        echo "Nepatvirtintas klientas";
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Sveikas atvykęs, <?php echo $teises_id[2]. "<br> Jūsų teisės: ".$row["aprasymas"]?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Klientai
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="klientupildymoforma.php">Pridėti naują klientą</a>
                    <a class="dropdown-item" href="klientai.php">Klientų peržiūra</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="imones.php">Peržiūrėti įmones</a>
            </li>
            <?php if($row["reiksme"]==1) { ?> <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Vartotojai
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Pridėti naują vartotoją</a>
                    <a class="dropdown-item" href="#">Vartotojų peržiūra</a>
                </div>
            </li> <?php } ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="clients.php" method="get">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search Client" aria-label="Search">
            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="search_button">Search</button>
        </form>
    </div>
</nav>