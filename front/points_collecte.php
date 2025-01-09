<?php

$host = 'localhost';
$dbname = 'bet'; 
$username = 'root';  
$password = '';  


$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "SELECT nom, latitude, longitude FROM points_collecte";
$stmt = $pdo->query($sql);
$points = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retourner les points au format JSON
echo json_encode($points);
?>
