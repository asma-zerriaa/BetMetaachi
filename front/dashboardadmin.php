<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bet";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlDonsRepas = "SELECT COUNT(*) AS total_dons_repas FROM fooddon";
$resultDonsRepas = $conn->query($sqlDonsRepas);
$totalDonsRepas = ($resultDonsRepas->num_rows > 0) ? $resultDonsRepas->fetch_assoc()['total_dons_repas'] : 0;


$sqlDonateurs = "SELECT COUNT(*) AS total_donateurs FROM users";
$resultDonateurs = $conn->query($sqlDonateurs);
$totalDonateurs = ($resultDonateurs->num_rows > 0) ? $resultDonateurs->fetch_assoc()['total_donateurs'] : 0;


$sqlDonsFinanciers = "SELECT SUM(amount) AS total_dons_financiers FROM donations";
$resultDonsFinanciers = $conn->query($sqlDonsFinanciers);


if (!$resultDonsFinanciers) {
    die("Erreur dans la requête SQL pour les dons financiers : " . $conn->error);
}


$row = $resultDonsFinanciers->fetch_assoc();
$totalDonsFinanciers = $row['total_dons_financiers'] ?? 0; 


$sqlPointsCollecte = "SELECT COUNT(*) AS total_points_collecte FROM points_collecte";
$resultPointsCollecte = $conn->query($sqlPointsCollecte);
$totalPointsCollecte = ($resultPointsCollecte->num_rows > 0) ? $resultPointsCollecte->fetch_assoc()['total_points_collecte'] : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Bet Metaachi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            font-size: 1.2em;
            font-weight: bold;
        }
        .card-body {
            text-align: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .sidebar {
            background-color: #3F1AE2;
            color: white;
            height: 100%;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
            font-size: 1.1em;
        }
        .sidebar a:hover {
            background-color: #009671;
        }
        .content {
            padding: 20px;
        }
        .sidebar a.active {
            background-color: #B3966F;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4>Tableau de Bord</h4>
        <a href="#" class="active">Dashboard</a>
        <a href="../back/gestion_dons.php">Gestion des Dons</a>
        <a href="../back/gerer_donateurs.php">Gestion des Donateurs</a>
        <a href="../back/ajout_points.php">Points de Collecte</a>
        <a href="#">Dons Financiers</a>
        <a href="#">Statistiques</a>
        <a href="../back/logout.php">Déconnexion</a>
    </div>

    <!-- Main Content -->
    <div class="content w-100">
        <div class="container-fluid">
            <!-- Row de Cartes -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="card text-white bg-success">
                        <div class="card-header">Total des Dons de Repas</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $totalDonsRepas; ?> Repas</h5>
                            <p class="card-text">Dons de repas collectés aujourd'hui.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-white bg-primary">
                        <div class="card-header">Total des Donateurs</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $totalDonateurs; ?> Donateurs</h5>
                            <p class="card-text">Commerçants et citoyens impliqués.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-white bg-warning">
                        <div class="card-header">Dons Financiers</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $totalDonsFinanciers; ?> TND</h5>
                            <p class="card-text">Montant des dons financiers collectés.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-white bg-info">
                        <div class="card-header">Points de Collecte</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $totalPointsCollecte; ?> Points</h5>
                            <p class="card-text">Lieux de collecte actifs.</p>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
