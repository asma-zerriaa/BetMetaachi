<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faire un Don</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eee8ca;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .donate-section {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 900px;
      width: 100%;
      text-align: center;
    }

    .donate-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #3F1AE2; /* Primary Title Color */
    }

    .donate-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease-in-out;
      max-width: 300px;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card-img-top {
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .card-title {
      color: #009671; /* Green for Titles */
    }

    .btn-donate {
      font-size: 1.2rem;
      font-weight: bold;
      border-radius: 8px;
      padding: 10px;
    }

    .btn-financier {
      background-color: #009671; /* Green for Financial Donation */
      color: white;
    }

    .btn-financier:hover {
      background-color: #007f5f;
    }

    .btn-nourriture {
      background-color: #3F1AE2; /* Purple for Food Donation */
      color: white;
    }

    .btn-nourriture:hover {
      background-color: #2c0fae;
    }

    footer {
      background-color: #B3966F; /* Footer with a Soft Gold Tone */
      color: white;
      padding: 10px;
      margin-top: 20px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <div class="donate-section">
    <h1 class="donate-title">Choisissez votre type de don</h1>
    <div class="donate-cards">

      <!-- Card 1: Don Financier -->
      <div class="card">
        <img src="https://via.placeholder.com/300x200?text=Don+Financier" class="card-img-top" alt="Don Financier">
        <div class="card-body">
          <h5 class="card-title">Faire un don financier</h5>
          <p class="card-text">Aidez-nous à financer des projets essentiels et soutenir notre cause.</p>
          <a href="../front/don.php" class="btn btn-donate btn-financier">Donner maintenant</a>
        </div>
      </div>

      <!-- Card 2: Don de Nourriture -->
      <div class="card">
        <img src="https://via.placeholder.com/300x200?text=Don+de+Nourriture" class="card-img-top" alt="Don de Nourriture">
        <div class="card-body">
          <h5 class="card-title">Faire un don de nourriture</h5>
          <p class="card-text">Contribuez à nourrir des familles dans le besoin avec des dons alimentaires.</p>
          <a href="../front/food.php" class="btn btn-donate btn-nourriture">Donner maintenant</a>
        </div>
      </div>

    </div>
  </div>

  <footer>
    &copy; 2024 betmetaachi. Tous droits réservés.
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
