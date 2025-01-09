<?php
// Connexion à la base de données
define("SERVEUR", "localhost");
define("USER", "root");
define("MDP", "");
define("NOMBASE", "bet");

$conn = mysqli_connect(SERVEUR, USER, MDP, NOMBASE);

if (mysqli_connect_errno()) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

$message = ""; // Variable pour stocker les messages d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Vérifier si l'email existe
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Vérifier le mot de passe
        if (password_verify($password, $user["password"])) {
            // Démarrer une session pour l'utilisateur
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_email"] = $user["email"];

            // Rediriger vers le tableau de bord
            header("Location: accuser.php");
            exit();
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $message = "Aucun utilisateur trouvé avec cet email.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
