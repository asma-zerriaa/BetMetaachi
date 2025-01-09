<?php
// Connexion à la base de données
define("SERVEUR", "localhost");
define("USER", "root");
define("MDP", "");
define("NOMBASE", "bet");

$conn = mysqli_connect(SERVEUR, USER, MDP, NOMBASE);

if (mysqli_connect_errno()) {
    echo "Échec de la connexion à la base de données";
    exit();
}

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['Password']) ? $_POST['Password'] : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';

    // Validation 
    if (strlen($name) < 2 || strlen($name) > 20) {
        $errors[] = "Le nom doit être entre 2 et 20 caractères.";
    }
    if ($age < 12 || $age > 120) {
        $errors[] = "L'âge doit être entre 12 et 120.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse email non valide.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }
    if (strlen($phone) != 8 || !is_numeric($phone)) {
        $errors[] = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
    }
    if (empty($latitude) || empty($longitude)) {
        $errors[] = "Les coordonnées géographiques sont requises.";
    }

    
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("INSERT INTO users (name, age, email, password, phone, latitude, longitude) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            echo "Erreur de préparation de la requête.";
            exit();
        }

        
        $stmt->bind_param("sisssss", $name, $age, $email, $hashed_password, $phone, $latitude, $longitude);

        if ($stmt->execute()) {
            echo "Données enregistrées avec succès !";
        } else {
            echo "Erreur lors de l'enregistrement : " . $stmt->error;
        }

        
        $stmt->close();
    } else {
        echo "<h2>Erreurs de validation :</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}

// Fermer la connexion
mysqli_close($conn);
?>