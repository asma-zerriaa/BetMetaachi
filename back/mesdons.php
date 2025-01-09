<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bet";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer la somme des dons financiers
$sqlDonsFinanciers = "SELECT SUM(amount) AS total_dons_financiers FROM donations";
$resultDonsFinanciers = $conn->query($sqlDonsFinanciers);
if ($resultDonsFinanciers) {
    $row = $resultDonsFinanciers->fetch_assoc();
    $totalDonsFinanciers = $row['total_dons_financiers'] ?? 0;
} else {
    $totalDonsFinanciers = 0;
}

// Fonction pour récupérer les dons selon une période (mensuel, hebdomadaire, annuel)
function getDonsByPeriod($conn, $period) {
    $query = "";
    if ($period == "monthly") {
        $query = "SELECT SUM(amount) AS total FROM donations WHERE MONTH(date) = MONTH(CURRENT_DATE) AND YEAR(date) = YEAR(CURRENT_DATE)";
    } elseif ($period == "weekly") {
        $query = "SELECT SUM(amount) AS total FROM donations WHERE YEARWEEK(date, 1) = YEARWEEK(CURRENT_DATE, 1)";
    } elseif ($period == "annually") {
        $query = "SELECT SUM(amount) AS total FROM donations WHERE YEAR(date) = YEAR(CURRENT_DATE)";
    }
    
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }
    return 0;
}

$monthlyDons = getDonsByPeriod($conn, "monthly");
$weeklyDons = getDonsByPeriod($conn, "weekly");
$annuallyDons = getDonsByPeriod($conn, "annually");

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard des Dons - Bet Metaachi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 15px 20px;
            display: block;
            font-size: 18px;
            border-bottom: 1px solid #495057;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            flex: 1;
        }
        .goal-progress {
            height: 30px;
            border-radius: 10px;
            background-color: #e0e0e0;
        }
        .progress-bar {
            height: 100%;
            border-radius: 10px;
        }
        .goal-text {
            font-size: 1.2em;
            margin-top: 10px;
            font-weight: bold;
        }
        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2 class="text-center text-white">Tableau de Bord</h2>
    <a href="../back/dashboarduser.php">Dashboard</a>
    <a href="../back/mesdons.php">Dons</a>
    <a href="../back/nouv.php">Nouveautés</a>
</div>

<!-- Content -->
<div class="content">
    <h2 class="text-center">Tableau de Bord des Dons</h2>

    <!-- Tableau des Dons -->
    <div class="row mt-4">
        <div class="col-12">
            <h4 class="text-center">Dons par Période</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Période</th>
                        <th>Montant des Dons (TND)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mensuel</td>
                        <td><?php echo $monthlyDons; ?> TND</td>
                    </tr>
                    <tr>
                        <td>Hebdomadaire</td>
                        <td><?php echo $weeklyDons; ?> TND</td>
                    </tr>
                    <tr>
                        <td>Annuel</td>
                        <td><?php echo $annuallyDons; ?> TND</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bouton pour Ajouter un Don -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="../front/don.php" class="btn btn-success">Ajouter un Nouveau Don</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
