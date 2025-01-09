<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eee8ca;
    }

    .navbar-container {
      max-width: 1200px;
      margin: 20px auto;
      background-color: #ffffff;
      border-radius: 50px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 0.5rem 1rem;
    }

    .navbar {
      padding: 0;
    }

    .navbar-brand {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      font-weight: bold;
      font-size: 1.5rem;
    }

    .nav-left, .nav-right {
      display: flex;
      align-items: center;
    }

    .nav-item {
      margin-left: 10px;
    }

    .btn-connexion {
      margin-left: 10px;
      padding: 0.375rem 0.75rem;
    }

    .hero-section {
      height: 80vh;
      background-color: #eee8ca;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .donate-now {
      display: flex;
      justify-content: center;
      margin: 30px 0;
    }

    
    #map {
      width: 80%;
      height: 400px;  
      margin: 20px auto;
    }

    footer {
      background-color: #343a40;
      color: white;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

  
  <div class="navbar-container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
       
        <div class="nav-left">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Volunteer Stories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
          </ul>
        </div>

        
        <a class="navbar-brand" href="#">MyWebsite</a>

        
        <div class="nav-right ms-auto">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Donate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-primary btn-sm btn-connexion" href="login.html">Log In</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-primary btn-sm btn-connexion" href="form.html">S'inscrire</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <!-- Hero Section -->
  <div class="hero-section">
    <div class="text-center">
      <h1>Feeding hope</h1>
      <p>changing lives</p>
    </div>
  </div>

  
  <div class="donate-now">
    <a href="choosedon.php" class="btn btn-danger btn-lg">Faire un don</a>
  </div>

  
  <div id="map"></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <!-- Leaflet JS  -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <script>
    // Initialiser la carte
  var map = L.map('map').setView([36.8065, 10.1815], 13);

// Ajouter une couche de tuiles (OpenStreetMap)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Charger les points de collecte depuis le fichier PHP
fetch('../back/points-collecte.php')
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    // Vérification des données et ajout des marqueurs
    if (Array.isArray(data) && data.length > 0) {
      data.forEach(point => {
        const latitude = parseFloat(point.latitude);
        const longitude = parseFloat(point.longitude);

        if (!isNaN(latitude) && !isNaN(longitude)) {
          // Ajouter un marqueur pour chaque point
          L.marker([latitude, longitude])
            .addTo(map)
            .bindPopup(`<b>${point.nom}</b><br>${point.adresse}`);
        } else {
          console.error('Coordonnées invalides:', point);
        }
      });
    } else {
      console.error('Aucun point à afficher ou données incorrectes.');
    }
  })
  .catch(error => {
    console.error('Erreur lors du chargement des points :', error);
  });
  </script>


  <!-- Footer -->
  <footer>
    <p>&copy; 2024 betmetaachi. All Rights Reserved.</p>
  </footer>
</body>
</html>
