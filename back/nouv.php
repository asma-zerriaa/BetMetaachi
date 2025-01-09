<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bet";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlManges = "SELECT COUNT(DISTINCT user_id) AS total_manges FROM fooddon"; // Table 'fooddon' pour les personnes ayant mangé
$resultManges = $conn->query($sqlManges);
$totalManges = ($resultManges && $row = $resultManges->fetch_assoc()) ? $row['total_manges'] : 0;


$sqlDonateurs = "SELECT COUNT(DISTINCT id) AS total_donateurs FROM fooddon"; // Table 'fooddon' pour les donateurs
$resultDonateurs = $conn->query($sqlDonateurs);
$totalDonateurs = ($resultDonateurs && $row = $resultDonateurs->fetch_assoc()) ? $row['total_donateurs'] : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bet Metaachi</title>
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
        .card {
            margin-top: 20px;
        }
        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-title {
            font-size: 1.5em;
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
    <h2 class="text-center">Nouveautés</h2>

    
    <div class="row">
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Nombre de Donateurs</h5>
                        <p class="card-text">Le nombre total de personnes ayant fait des dons.</p>
                    </div>
                    <div>
                        <h3><?php echo $totalDonateurs; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card for People Who Ate -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Nombre de Personnes Ayant Mangé</h5>
                        <p class="card-text">Le nombre total de personnes ayant mangé.</p>
                    </div>
                    <div>
                        <h3><?php echo $totalManges; ?></h3>
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
