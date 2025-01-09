<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "bet");

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération des valeurs du formulaire
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$food_type = $_POST['food_type'];
$quantity = $_POST['quantity'];
$deadline = $_POST['deadline'];

$description = $_POST['description'];

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];

// Insertion dans la base de données sans photo
$sql = "INSERT INTO fooddon (name, email, phone, donation_type, food_type, quantity, deadline, description, latitude, longitude, pickup_date, pickup_time) 
        VALUES ('$name', '$email', '$phone', 'food', '$food_type', '$quantity', '$deadline', '$description', '$latitude', '$longitude', '$pickup_date', '$pickup_time')";

if ($conn->query($sql) === TRUE) {
    echo "Nouveau don enregistré avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
