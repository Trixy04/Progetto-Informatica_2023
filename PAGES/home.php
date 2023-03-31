<?php
session_start();
include("../CONFIG/config.php");

if (!isset($_SESSION["nominativo"])) {
    header("Location: ../index.php");
}

if (isset($_GET["name"])) {
    deleteSession();
}

if (isset($_GET["add"])&& $_GET["add"]=='true') {
    addEvent();
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

$sqlAgenda = "SELECT dataScad, titolo, autore FROM `agenda` ORDER BY dataScad";
$result = $conn->query($sqlAgenda);
$tabella_agenda = "";
$i = 1;
while ($row = $result->fetch_assoc()) {

    $data = $row["dataScad"];
    $timestamp_data = strtotime($data); // Formato della data che voglio ottenere in uscita dalla funzione date()
    $formato = 'd/m/Y';
    $resultDate = date($formato, $timestamp_data);

    $tabella_agenda .= "<tr>
    <td>" . $i . "</td>
    <td>" . $resultDate . "</td>
    <td>" . $row["titolo"] . "</td>
    <td> " . $row["autore"] . "</td>
    </tr>";
    $i++;
    if($i == 9){
        break;
    }
}

$conn = null;


function deleteSession()
{
    session_start();
    session_destroy();
    header("Location: ../index.php");
}

function addEvent()
{
    include("../CONFIG/config.php");
    $titolo = $_POST["titolo"];
    $descrizione = $_POST["descrizione"];
    $dataScadenza = $_POST["datascadenza"];
    $autore = $_SESSION["nominativo"];
    $dataCreazione = date("Y/m/d");

    $sql = "INSERT INTO agenda (dataIns, dataScad, textMess, autore, titolo)
    VALUES ('$dataCreazione', '$dataScadenza', '$descrizione', '$autore', '$titolo')";
    if (mysqli_query($conn, $sql)) {
        header("Location: home.php?add=false");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $conn = null;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css" type="text/css">
    <title>HOME</title>
</head>

<body>

    <div class="sidebar">
        <center><img src="../ICON/LOGO.png" alt="Bootstrap" width="60" height="70" class="mt-3"></center>

        <a href="#" class="">Home</a>
        <a href="#" class="">Società</a>
        <a href="Pages/agenda.php" class="">Agenda</a>
        <a href="#">Organigramma</a>
        <a href="#">Squadre</a>
        <a href="#">Contabilità</a>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand font-15" href="#">PALLAVOLO SESTESE A.S.D</a>
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

        <div class="container ">
            <div class="row">
                <div class="col">
                    <div class="card radius-bord" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill mr-2" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                </svg>TOT. Atleti</h5>
                            <p class="card-text fs-3"><?php echo $tot_atleti ?></p>
                            <a href="#" class="btn btn-primary">Vai alla sezione atleti</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-bord" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill mr-2" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                </svg>TOT. Allenatori</h5>
                            <p class="card-text fs-3"><?php echo $tot_allenatori ?></p>
                            <a href="#" class="btn btn-primary">Vai alla sezione allenatori</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-bord" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill mr-2" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                </svg>TOT. Dirigenti</h5>
                            <p class="card-text fs-3"><?php echo $tot_dirigenti ?></p>
                            <a href="#" class="btn btn-primary">Vai alla sezione dirigenti</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-bord" style="width: 18rem; ">
                        <div class="card-body">
                            <h5 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill mr-2" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                </svg>Certificati in scadenza</h5>
                            <p class="card-text fs-3"><?php echo $tot_atleti ?></p>
                            <a href="#" class="btn btn-primary">Visualizza certficati</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="div-agenda radius-bord border">
            <i>
                <h5 class="text-center mt-3">Impegni in scandeza agenda<button type="button" class="btn btn-success ml-5" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg></button></h5>


            </i>
            <center>
                <table class="table mt-3 w-85">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data Scadenza</th>
                            <th scope="col">Impegno</th>
                            <th scope="col">Autore</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $tabella_agenda; ?>
                    </tbody>
                </table>
            </center>
        </div>

        <div class="div-calendar radius-bord border ">
            <i>
                <h5 class="text-center mt-3">Calendario</h5>
            </i>
            <center>
                <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%23ffffff&ctz=Europe%2FRome&title=Pallavolo%20Sestese&src=dGVyaWFjYS5tYXR0aWFAZ21haWwuY29t&src=aXQuaXRhbGlhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23039BE5&color=%230B8043" style="border-width:0" width="90%" height="400" frameborder="0" scrolling="no" class="mb-3"></iframe>
            </center>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserisci un nuovo impegno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="home.php?add=true" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Titolo evento</label>
                            <input type="text" class="form-control" name="titolo" id="formGroupExampleInput" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Descrizione</label>
                            <textarea class="form-control" name="descrizione" id="exampleFormControlTextarea1" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="active form-label" for="dateStandard">Data Scadenza</label>
                            <input type="date" id="dateStandard" name="datascadenza">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>