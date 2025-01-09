<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de Don de Nourriture</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery & jQuery Validation CSS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <style>
    body {
      background-color: #f4f4f4;
    }
    .card-header {
      background-color: #009671;
      color: white;
    }
    .btn-success {
      background-color: #009671;
      border-color: #009671;
    }
    .btn-success:hover {
      background-color: #3F1AE2;
      border-color: #3F1AE2;
    }
    .form-label {
      color: #3F1AE2;
    }
    .form-control {
      border-color: #B3966F;
    }
    .form-control:focus {
      border-color: #3F1AE2;
      box-shadow: 0 0 0 0.25rem rgba(63, 26, 226, 0.25);
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header text-center">
        <h2>Faire un Don de Nourriture</h2>
      </div>
      <div class="card-body">
        <form id="donation-form" action="../back/submit-donation.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="name" class="form-label">Nom Complet</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom complet" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Adresse E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Numéro de Téléphone (Optionnel)</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone">
          </div>
          <div class="mb-3">
            <label for="food-type" class="form-label">Type de Nourriture</label>
            <select class="form-select" id="food-type" name="food_type" required>
              <option value="vegetables">Légumes</option>
              <option value="fruits">Fruits</option>
              <option value="meat">Viande</option>
              <option value="dairy">Produits Laitiers</option>
              <option value="packaged">Aliments Emballés</option>
              <option value="other">Autre</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Entrez la quantité (par exemple, 2 kg, 5 litres)" required>
          </div>
          <div class="mb-3">
            <label for="deadline" class="form-label">Date Limite Avant Péremption</label>
            <input type="date" class="form-control" id="deadline" name="deadline">
          </div>
          <div class="mb-3">
            <label for="freshness-scale" class="form-label">Échelle de Fraîcheur</label>
            <select class="form-select" id="freshness-scale" name="freshness_scale" required>
              <option value="1">1 - Très Frais</option>
              <option value="2">2 - Frais</option>
              <option value="3">3 - Moyennement Frais</option>
              <option value="4">4 - Presque Perimé</option>
              <option value="5">5 - Complètement Perimé</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description (Facultatif)</label>
            <textarea class="form-control" id="description" name="description" placeholder="Décrivez votre don (facultatif)"></textarea>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <label for="latitude" class="form-label">Latitude</label>
              <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" required readonly>
            </div>
            <div class="col-md-6">
              <label for="longitude" class="form-label">Longitude</label>
              <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" required readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="pickup_date" class="form-label">Date de Collecte</label>
              <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
            </div>
            <div class="col-md-6">
              <label for="pickup_time" class="form-label">Heure de Collecte</label>
              <!-- Limité entre 18h et 20h -->
              <input type="time" class="form-control" id="pickup_time" name="pickup_time" >
            </div>
          </div>
          <div class="mb-3">
            <label for="photo" class="form-label">Ajouter une Photo (Facultatif)</label>
            <input type="file" class="form-control" id="photo" name="photo_url" accept="image/*">
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Soumettre le Don</button>
          </div>
        </form>
        <button class="btn btn-info mt-3" onclick="getLocation()">Obtenir ma Position</button>
      </div>
    </div>
  </div>

  <script>
    // Fonction pour récupérer la position de l'utilisateur
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
        alert("La géolocalisation n'est pas supportée par ce navigateur.");
      }
    }

    // Fonction pour afficher la position dans les champs latitude et longitude
    function showPosition(position) {
      document.getElementById("latitude").value = position.coords.latitude;
      document.getElementById("longitude").value = position.coords.longitude;
    }

    // Fonction pour gérer les erreurs de géolocalisation
    function showError(error) {
      switch(error.code) {
        case error.PERMISSION_DENIED:
          alert("L'utilisateur a refusé la demande de géolocalisation.");
          break;
        case error.POSITION_UNAVAILABLE:
          alert("La position de l'utilisateur est indisponible.");
          break;
        case error.TIMEOUT:
          alert("La demande de géolocalisation a expiré.");
          break;
        case error.UNKNOWN_ERROR:
          alert("Une erreur inconnue s'est produite.");
          break;
      }
    }

    // Validation avec jQuery
    // Validation avec jQuery
$(document).ready(function () {
  $("#donation-form").validate({
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true
      },
      quantity: {
        required: true,
      },
      food_type: {
        required: true,
      },
      pickup_date: {
        required: true,
      },
      pickup_time: {
        required: true
      }
    },
    messages: {
      pickup_time: {
        required: "Veuillez indiquer une heure de collecte.",
      }
    }
  });
});

  </script>
</body>
</html>
