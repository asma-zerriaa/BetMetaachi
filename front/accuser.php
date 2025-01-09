<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$user_name = $_SESSION["user_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    footer {
      background-color: #343a40;
      color: white;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <div class="navbar-container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        
        <!-- Left Links -->
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

        <!-- Center Logo -->
        <a class="navbar-brand" href="#">MyWebsite</a>

        <!-- Right Links -->
        <div class="nav-right ms-auto">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Donate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <!-- Utilisateur Connecté -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle me-2"></i>
                <?php echo htmlspecialchars($user_name); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="../back/dashboarduser.php">Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
