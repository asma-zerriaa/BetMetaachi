<?php
session_start();

// bd
$conn = new mysqli("localhost", "root", "", "bet");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}


$inputEmail = $_POST['email'];
$inputPassword = $_POST['password'];

// nthabtou ml mail w mdp
$sql = "SELECT * FROM admin_users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $inputEmail, $inputPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    $_SESSION['admin_email'] = $inputEmail;
    header('Location: ../front/dashboardadmin.php');
    exit();
} else {
   
    echo "Email ou mot de passe incorrect.";
}


$conn->close();
?>
