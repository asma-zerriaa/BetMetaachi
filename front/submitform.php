<?php
// Connexion à la base de données
define("SERVEUR", "localhost");
define("USER", "root");
define("MDP", "");
define("NOMBASE", "user_data");

$conn = mysqli_connect(SERVEUR, USER, MDP, NOMBASE);

if (mysqli_connect_errno()) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    
    $errors = [];
    if (strlen($name) < 2 || strlen($name) > 20) {
        $errors[] = "Le nom doit être entre 2 et 20 caractères.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse email non valide.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    if (!empty($errors)) {
        echo "<h2>Erreurs de validation :</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        
        session_start();
        $_SESSION["user_id"] = mysqli_insert_id($conn); 
        $_SESSION["user_name"] = $name;
        $_SESSION["user_email"] = $email;

        
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Erreur lors de l'inscription : " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
