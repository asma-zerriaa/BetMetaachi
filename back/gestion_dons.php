<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les dons de nourriture
$sql = "SELECT * FROM fooddon WHERE status = 'En attente'";
$result = $conn->query($sql);

// Valider un don
if (isset($_GET['validate'])) {
    $id = $_GET['validate'];
    $updateStatus = "UPDATE fooddon SET status = 'Validé' WHERE id = $id";
    if ($conn->query($updateStatus) === TRUE) {
        echo "Don validé avec succès!";
    } else {
        echo "Erreur lors de la validation du don: " . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Dons - Bet Metaachi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            width: 100%;
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
    <div class="content">
        <div class="container mt-4">
            <h2>Liste des Dons en Attente</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nom du Donateur</th>
                        <th scope="col">Type de Repas</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Date Limite</th>
                        <th scope="col">Date de Collecte</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Reconnexion pour récupérer les résultats
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['food_type'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['deadline'] . "</td>";
                            echo "<td>" . $row['pickup_date'] . " " . $row['pickup_time'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td><a href='gestion_dons.php?validate=" . $row['id'] . "' class='btn btn-success'>Valider</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Aucun don en attente.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
