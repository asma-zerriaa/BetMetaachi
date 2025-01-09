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

// Ajouter un nouveau point de collecte
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_point'])) {
    $nom = $_POST['nom'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $adresse = $_POST['adresse'];

    $insertPoint = "INSERT INTO points_collecte (nom, latitude, longitude, adresse) VALUES ('$nom', '$latitude', '$longitude', '$adresse')";
    if ($conn->query($insertPoint) === TRUE) {
        echo "<script>alert('Point de collecte ajouté avec succès!');</script>";
    } else {
        echo "<script>alert('Erreur: " . $conn->error . "');</script>";
    }
}

// Récupérer les points de collecte
$sqlPoints = "SELECT * FROM points_collecte";
$resultPoints = $conn->query($sqlPoints);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Points de Collecte - Bet Metaachi</title>
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
        }
        .sidebar a:hover {
            background-color: #009671;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4>Tableau de Bord</h4>
        <a href="../front/dashboardadmin.php">Dashboard</a>
        <a href="../back/gestion_dons.php">Gestion des Dons</a>
        <a href="../back/gerer_donateurs.php">Gestion des Donateurs</a>
        <a href="../back/ajout_points.php">Points de Collecte</a>
        <a href="#">Dons Financiers</a>
        <a href="#">Statistiques</a>
        <a href="../back/logout.php">Déconnexion</a>
    </div>

    <!-- Main Content -->
    <div class="content w-100">
        <div class="container">
            <h2 class="mb-4">Gestion des Points de Collecte</h2>

            <!-- Formulaire d'ajout -->
            <div class="card mb-4">
                <div class="card-header">Ajouter un Point de Collecte</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="adress" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="ajouter_point">Ajouter</button>
                    </form>
                </div>
            </div>

            <!-- Liste des points de collecte -->
            <div class="card">
                <div class="card-header">Liste des Points de Collecte</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Adresse</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($resultPoints->num_rows > 0): ?>
                                <?php while ($row = $resultPoints->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['nom']; ?></td>
                                        <td><?= $row['latitude']; ?></td>
                                        <td><?= $row['longitude']; ?></td>
                                        <td><?= $row['adresse']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">Aucun point de collecte trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
