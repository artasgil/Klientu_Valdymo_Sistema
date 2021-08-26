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
    <div class="navbar-brand">Sveikas atvykęs, <?php echo $teises_id[2] . "<br> Jūsų teisės: " . $row["aprasymas"] ?>
        <?php echo "<form action='adminPanel.php' method ='post'>";
        echo "<button class='btn btn-light' type='submit' name='logout'>Atsijungti</button>";
        echo "</form>";
        if (isset($_POST["logout"])) {
            setcookie("prisijungta", "", time() - 3600, "/");
            header("Location: prisijungimas.php");
        } ?> </div>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Įmonės
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="imoniupildymoforma.php">Pridėti naują įmonę</a>
                    <a class="dropdown-item" href="imones.php">Įmonių peržiūra</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if ($row["reiksme"] == 2) { echo "disabled"; } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Vartotojai
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item <?php if ($row["reiksme"] == 3) {
                                                echo "disabled";
                                            } ?>" href="vartotojupildymoforma.php">Pridėti naują vartotoją</a>
                    <a class="dropdown-item" href="vartotojai.php">Vartotojų peržiūra</a>
                </div>
            </li>
        </ul>
        <?php if ($row["reiksme"] == 1) { ?>                                   
        <form class="form-inline">
            <select class="form-control" name="pasirinkimas">
                <option value="1">Įjungti registraciją</option>
                <option value="2">Išjungti registracija</option>
            </select>
            <button class="btn btn-primary inline" type="submit" name="patvirtinti">Patvirtinti</button>
        </form>
            <?php } ?>
            <?php require_once("includes/registracijos_isjungimas.php"); ?>
    </div>
</nav>