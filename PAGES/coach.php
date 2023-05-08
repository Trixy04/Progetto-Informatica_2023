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

$sqlGiocatori = "SELECT P.data_nascita AS dataNascita, P.cod_utente AS id, P.cod_fiscale AS codFiscale, P.nome AS nome, P.cognome AS cognome, A.smartCoach AS smart, qF.qualificaFipav AS qualificaFipav FROM allenatore AS A
JOIN persona AS P ON P.cod_utente = A.id_persona
JOIN cartellino AS C ON A.id_cartellino = C.id
JOIN qualificaFipav as qF ON qF.id = C.id_qualifica
ORDER BY cognome";

$result = $conn->query($sqlGiocatori);
$tabella_giocatori = "";
while ($row = $result->fetch_assoc()) {
    $cf = $row["codFiscale"];
    $dataN = $row["dataNascita"];
    $timestamp_dataN = strtotime($dataN);
    $formato = 'd/m/Y';
    $resultDateN = date($formato, $timestamp_dataN);

    if($row["smart"] == 1){
        $smartCoach = "checked";
    }else{
        $smartCoach = "";
    }

    $tabella_giocatori .= "<tr valign='middle'>
    <td>" . $row["id"] . "</td>
    <td> " . $row["codFiscale"] . "</td>
    <td> " . $row["cognome"] . "</td>
    <td> " . $row["nome"] . "</td>
    <td> " . $resultDateN . "</td>
    <td> " . $row["qualificaFipav"] . "</td>
    <td style='text-align:center'> <input class='form-check-input' type='checkbox' value='' id='flexCheckDefault' $smartCoach  disabled></td>
    <td><a href='showCoach.php?cf=$cf'><button class='btn btn-success'>Show</button></a></td>
    </tr>";
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
    <title>ALLENATORI</title>
</head>

<body>

<div class="sidebar">
        <center><img src="../ICON/LOGO.png" alt="Bootstrap" width="80" height="80" class="mt-3"></center>

        <a href="home.php" class="over">Home</a>
        <a href="player.php" class="over">Atleti</a>
        <a href="coach.php" class="over">Allenatori</a>
        <a href="agenda.php" class="over">Agenda</a>
        <a href="certificati.php" class="over">Certificati</a>
        <button class="dropdown-btn">Squadre
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <?php
            $sqlTeam = "SELECT nome, id FROM `squadra`";
            $result = $conn->query($sqlTeam);
            echo "<a class='over' href='team.php'>Gestisci squadre</a>";
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $nome = $row["nome"];
                echo "<a class='over' href='generateTeam.php?squadra=$id'>$nome</a>";
            }
            $conn = null;
            ?>
        </div>
    </div>
    <div class="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand font-15" href="#"><?php echo strtoupper(recuperaDatiSocieta()) ?></a>
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

        <div class="div-utenti radius-bord border">
            <i>
                <h5 class="text-center mt-3">Allenatori <?php
                                                        $nome = recuperaDatiSocieta();
                                                        echo $nome;
                                                        ?></h5>
            </i>
            <center>
                <form class="d-flex w-50" action="showCoach.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Cerca per codice fiscale" aria-label="Search" name="cf">
                    <button class="btn btn-outline-success" type="submit">Cerca</button>
                </form>
                <button type="button" class="btn btn-primary text-white backBlue mt-2 b-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Inserisci
                </button>
                <table class="table mt-3 w-85">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cod. Fiscale</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data nascita</th>
                            <th scope="col">Qualifica</th>
                            <th style="text-align: center;" scope="col">Smart Coach</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $tabella_giocatori; ?>
                    </tbody>
                </table>
            </center>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Scegli modalità di inserimento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <a href="insertCoach.php" class="btn btn-primary" style="background-color: #012E63; border: 0px solid white">Inserendo nuova persona</a>
                <a href="esistenteCoach.php" class="btn btn-primary" style="background-color: #012E63; border: 0px solid white">Utilizzando persona già inserita</a>

                </div>
            </div>
        </div>
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