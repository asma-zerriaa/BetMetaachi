<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "bet";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupérer les donateurs
$sql = "SELECT id, name, email, phone, latitude, longitude FROM users";  
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Donateurs - Panneau d'Administration</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.min.js"></script>
    
    <link href="../assets/DataTables/datatables.min.css" rel="stylesheet">
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/DataTables/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#donateursTable').DataTable();
        });
    </script>

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
        }
        .sidebar a.active {
            background-color: #B3966F;
        }
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
        }
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
            <h2 class="text-center mt-4">Gestion des Donateurs</h2>

            <div class="row mt-4">
                <div class="col-md-12">
                    <table id="donateursTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Afficher chaque donateur
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['phone'] . "</td>";
                                    echo "<td>" . $row['latitude'] . "</td>";  
                                    echo "<td>" . $row['longitude'] . "</td>";  
                                    // Lien de modification
                                    echo "<td><a href='modifier_donateur.php?edit_id=" . $row['id'] . "' class='btn btn-warning'>Modifier</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Aucun donateur trouvé.</td></tr>";  
                            }
                            ?>
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
<script src="../assets/DataTables/datatables.min.js"></script>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
