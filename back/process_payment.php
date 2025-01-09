<?php
session_start();


if (!isset($_SESSION['email'])) {
    die("Vous devez être connecté pour effectuer un don.");
}

$email = $_SESSION['email'];
$amount = $_POST['amount'] ?? 0;

if ($amount <= 0) {
    die("Montant invalide.");
}


$host = 'localhost';
$dbname = 'bet';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // nekhdhou l id taa l user connecté
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $userId = $stmt->fetchColumn();

    if (!$userId) {
        die("Utilisateur non trouvé.");
    }

    
    $stmt = $pdo->prepare("INSERT INTO donations (user_id, amount) VALUES (?, ?)");
    $stmt->execute([$userId, $amount]);

    echo "Merci, " . htmlspecialchars($email) . ", pour votre don de $amount TND.";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
