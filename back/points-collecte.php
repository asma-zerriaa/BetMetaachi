<?php
$servername = "localhost";  
$username = "root";        
$password = "";             
$dbname = "bet";           


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}


$sql = "SELECT nom, latitude, longitude, adresse FROM points_collecte";
$result = $conn->query($sql);

// nthabtou ken res tbaathou
if ($result->num_rows > 0) {
    
    $points_collecte = array();

    
    while($row = $result->fetch_assoc()) {
        $points_collecte[] = $row;
    }

    
    echo json_encode($points_collecte);
} else {
    echo "0 résultats";
}

// Fermer la connexion à la base de données
$conn->close();
?>
