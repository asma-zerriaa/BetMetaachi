<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
    
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/jquery/jquery.validate.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Formulaire d'Inscription</h2>
        <form id="signup-form" method="post" action="../back/submit.php">
            <div class="form-group">
                <label for="name">Nom</label>
                <input name="name" type="text" id="name" class="form-control" placeholder="Nom" minlength="3" maxlength="100" required>
            </div>
            
            <div class="form-group">
                <label for="age">Âge</label>
                <input name="age" type="number" id="age" class="form-control" placeholder="Âge" min="12" max="100" required>
            </div>
            
            <div class="form-group">
                <label for="email">Adresse E-mail</label>
                <input name="email" type="email" id="email" class="form-control" placeholder="Adresse E-mail" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input name="Password" type="password" id="password" class="form-control" placeholder="Mot de passe" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Numéro de téléphone</label>
            
                <input name="phone" type="tel" id="phone" class="form-control" placeholder="Numéro de téléphone" pattern="^[0-9]{8}$" required>
                <small class="form-text text-muted">Entrez un numéro à 8 chiffres.</small>
            </div>
            
            <label for="latitude">Latitude:</label>
  <input type="text" id="latitude" name="latitude" ><br><br>

  <label for="longitude">Longitude:</label>
  <input type="text" id="longitude" name="longitude" ><br><br>

  <!-- Btn bch nekhdhou l localisation -->
  <button type="button" onclick="getLocation()">Obtenir la localisation</button><br><br>

            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>
    <script>function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            // tekhou l long w lat
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            //taabi l cases long w lat
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
        }, function(error) {
            alert("Erreur lors de la récupération de la localisation : " + error.message);
        });
    } else {
        alert("La géolocalisation n'est pas supportée par votre navigateur.");
    }
}

</script>

    <script>

        // nvaldou l form
        $(document).ready(function() {
            $("#signup-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    age: {
                        required: true,
                        min: 12,
                        max: 100
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    Password: {
                        required: true,
                        minlength: 6
                    },
                    phone: {
                        required: true,
                        pattern: /^[0-9]{8}$/
                    }
                },
                messages: {
                    name: {
                        required: "Veuillez entrer votre nom.",
                        minlength: "Votre nom doit comporter au moins 3 caractères."
                    },
                    age: {
                        required: "Veuillez entrer votre âge.",
                        min: "L'âge doit être d'au moins 12 ans.",
                        max: "L'âge doit être inférieur ou égal à 100 ans."
                    },
                    email: {
                        required: "Veuillez entrer votre adresse e-mail.",
                        email: "Veuillez entrer une adresse e-mail valide."
                    },
                    Password: {
                        required: "Veuillez entrer un mot de passe.",
                        minlength: "Le mot de passe doit comporter au moins 6 caractères."
                    },
                    phone: {
                        required: "Veuillez entrer votre numéro de téléphone.",
                        pattern: "Veuillez entrer un numéro de téléphone valide (8 chiffres)."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.js"></script>

</body>
</html>
