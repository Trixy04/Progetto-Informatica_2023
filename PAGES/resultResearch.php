<?php
session_start();
include("../CONFIG/config.php");
include("../CONFIG/function.php");
$dataOdierna = date("Y-m-d");

if (!isset($_SESSION["nominativo"])) {
    header("Location: ../index.php");
}

if (isset($_GET["name"])) {
    deleteSession();
}

if (isset($_GET["add"]) && $_GET["add"] == 'true') {
    addEvent();
}

if (isset($_GET["research"]) && $_GET["research"] == 'true') {
    echo "<script language='javascript'> $(document).ready(function() { $('#exampleModal').modal('show'); }); </script>";

    $sqlRicerca = "SELECT P.data_nascita AS dataNascita, P.cod_utente AS id, P.cod_fiscale AS codFiscale, P.nome AS nome, P.cognome AS cognome, S.nome AS squadra, GR.num_maglia AS maglia FROM gioca AS G
    JOIN giocatore AS GR ON G.id_giocatore = GR.id
    JOIN persona AS P ON GR.id_persona = P.cod_utente
    JOIN contatto AS C ON C.id = P.id_contatti
    JOIN squadra AS S ON G.id_squadra = S.id
    WHERE codFiscale = '$cf'";


    $result = $conn->query($sqlRicerca);
    $tabella_risultato = "";
    if ($result > 0) {
        while ($row = $result->fetch_assoc()) {
            $dataN = $row["dataNascita"];
            $timestamp_dataN = strtotime($dataN);
            $formato = 'd/m/Y';
            $resultDateN = date($formato, $timestamp_dataN);

            $tabella_risultato .= "<tr>
            <td>" . $row["id"] . "</td>
            <td> " . $row["codFiscale"] . "</td>
            <td> " . $row["cognome"] . "</td>
            <td> " . $row["nome"] . "</td>
            <td> " . $resultDateN . "</td>
            <td> " . $row["maglia"] . "</td>
            <td> " . $row["squadra"] . "</td>
            </tr>";

            header("Location: ../PAGES/home.php?openModal=true");
        }
    }
}

$sqlAtleti = "SELECT COUNT(*) AS tot FROM `giocatore`";
$result = $conn->query($sqlAtleti);

while ($row = $result->fetch_assoc()) {
    $tot_atleti = $row["tot"];
}

$sqlDirigenti = "SELECT COUNT(*) AS tot FROM `dirigente`";
$result = $conn->query($sqlDirigenti);

while ($row = $result->fetch_assoc()) {
    $tot_dirigenti = $row["tot"];
}

$sqlAllenatori = "SELECT COUNT(*) AS tot FROM `allenatore`";
$result = $conn->query($sqlAllenatori);

while ($row = $result->fetch_assoc()) {
    $tot_allenatori = $row["tot"];
}

$sqlSquadre = "SELECT id, nome FROM `squadra`";
$result = $conn->query($sqlSquadre);
$tabella_squadra = "";
while ($row = $result->fetch_assoc()) {
    $name = $row["nome"];
    $tabella_squadra .= "<tr>
    <td>" . $row["id"] . "</td>
        <td><a href='generateTeam.php?squadra=$name'>" . $row["nome"] . "</a></td>
    </tr>";
}

$sqlGiocatori = "SELECT P.data_nascita AS dataNascita, P.cod_utente AS id, P.cod_fiscale AS codFiscale, P.nome AS nome, P.cognome AS cognome, S.nome AS squadra, GR.num_maglia AS maglia FROM gioca AS G
JOIN giocatore AS GR ON G.id_giocatore = GR.id
JOIN persona AS P ON GR.id_persona = P.cod_utente
JOIN contatto AS C ON C.id = P.id_contatti
JOIN squadra AS S ON G.id_squadra = S.id";

$result = $conn->query($sqlGiocatori);
$tabella_giocatori = "";
while ($row = $result->fetch_assoc()) {

    $dataN = $row["dataNascita"];
    $timestamp_dataN = strtotime($dataN);
    $formato = 'd/m/Y';
    $resultDateN = date($formato, $timestamp_dataN);

    $tabella_giocatori .= "<tr>
    <td>" . $row["id"] . "</td>
    <td> " . $row["codFiscale"] . "</td>
    <td> " . $row["cognome"] . "</td>
    <td> " . $row["nome"] . "</td>
    <td> " . $resultDateN . "</td>
    <td> " . $row["maglia"] . "</td>
    <td> " . $row["squadra"] . "</td>
    </tr>";
}


$sqlAgenda = "SELECT dataScad, titolo, autore FROM `agenda` WHERE dataScad >= '$dataOdierna' ORDER BY dataScad";

$result = $conn->query($sqlAgenda);
$tabella_agenda = "";
$i = 1;
while ($row = $result->fetch_assoc()) {

    $data = $row["dataScad"];
    $timestamp_data = strtotime($data); // Formato della data che voglio ottenere in uscita dalla funzione date()
    $resultDate = date($formato, $timestamp_data);

    if ($data == $dataOdierna) {
        $tabella_agenda .= "<tr style='background-color: #FF5733; color: white; font-style: italic;'>
        <td>" . $i . "</td>
        <td><b>" . $resultDate . "</b></td>
        <td>" . $row["titolo"] . "</td>
        <td> " . $row["autore"] . "</td>
    </tr>";
    } else {
        $tabella_agenda .= "<tr>
        <td>" . $i . "</td>
        <td>" . $resultDate . "</td>
        <td>" . $row["titolo"] . "</td>
        <td> " . $row["autore"] . "</td>
        </tr>";
    }
    $i++;
    if ($i == 9) {
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css" type="text/css">
    <title>HOME</title>
</head>

<body>

    <div class="sidebar">
        <center><img src="../ICON/LOGO.png" alt="Bootstrap" width="80" height="80" class="mt-3"></center>

        <a href="home.php" class="">Home</a>
        <a href="#" class="">Società</a>
        <a href="Pages/agenda.php" class="">Agenda</a>
        <a href="#">Organigramma</a>
        <button class="dropdown-btn">Squadre
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <?php
            $sqlTeam = "SELECT nome FROM `squadra`";
            $result = $conn->query($sqlTeam);
            while ($row = $result->fetch_assoc()) {
                $team = $row["nome"];
                echo "<a href='generateTeam.php?squadra=$team'>$team</a>";
            }
            $conn = null;
            ?>
        </div>
        <a href="#">Contabilità</a>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand font-15" href="#">SAVINO DEL BENE VOLLEY</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <div class="dropdown-center">
                            <a class="dropdown-toggle nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION["nominativo"] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Gestisci profilo</a></li>
                                <li><a class="dropdown-item" href="#">Action two</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="home.php?name=true">Logout</a></li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>