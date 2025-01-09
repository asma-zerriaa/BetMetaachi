<?php
// bd
$servername = "localhost";
$username = "root";  
$password = "";  // 
$dbname = "bet";  // 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// ken l id taada f url
if (isset($_GET['edit_id'])) {
    $donateur_id = $_GET['edit_id'];

    // njibou les infos
    $sql = "SELECT id, name, email, phone, latitude, longitude FROM users WHERE id = $donateur_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // lhne les données
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
    } else {
        echo "Donateur non trouvé.";
        exit;
    }
} else {
    echo "Aucun ID trouvé.";
    exit;
}

// kn l form tebaath
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updated_name = $_POST['name'];
    $updated_email = $_POST['email'];
    $updated_phone = $_POST['phone'];
    $updated_latitude = $_POST['latitude'];
    $updated_longitude = $_POST['longitude'];

    // msj les infos
    $update_query = "UPDATE users SET name = '$updated_name', email = '$updated_email', phone = '$updated_phone', latitude = '$updated_latitude', longitude = '$updated_longitude' WHERE id = $donateur_id";

    if ($conn->query($update_query) === TRUE) {
        echo "Les informations du donateur ont été mises à jour avec succès.";
    } else {
        echo "Erreur: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Donateur</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="text-center mt-4">Modifier les Informations du Donateur</h2>

    <form method="POST" action="modifier_donateur.php?edit_id=<?php echo $donateur_id; ?>" class="mt-4">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>" required>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="text" name="latitude" id="latitude" class="form-control" value="<?php echo $latitude; ?>" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude</label>
            <input type="text" name="longitude" id="longitude" class="form-control" value="<?php echo $longitude; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>

    <a href="gerer_donateurs.php" class="btn btn-secondary mt-3">Retour à la gestion des donateurs</a>
</div>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
