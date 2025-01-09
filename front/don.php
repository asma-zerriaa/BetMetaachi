<?php
session_start();
// Simuler un utilisateur connecté
$_SESSION['email'] = 'asma@asma.com'; // Changez pour tester avec d'autres utilisateurs.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faire un Don - Bet Metaachi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Faire un Don</h2>

        <form id="donForm" action="../back/payment_simulation.php" method="GET">
            <div class="form-group">
                <label for="amount">Montant du Don (en Dinars)</label>
                <select class="form-control" id="amount" name="amount" required>
                    <option value="">Choisissez un montant</option>
                    <option value="5">5 Dinars</option>
                    <option value="10">10 Dinars</option>
                    <option value="20">20 Dinars</option>
                    <option value="50">50 Dinars</option>
                    <option value="100">100 Dinars</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Confirmer le Don</button>
        </form>
    </div>

    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
           
            $("#donForm").validate({
                rules: {
                    amount: {
                        required: true,
                        notEqual: "" // ken montant tselectionna wale 
                    }
                },
                messages: {
                    amount: {
                        required: "Veuillez sélectionner un montant",
                        notEqual: "Veuillez sélectionner un montant valide"
                    }
                },
                submitHandler: function(form) {
                    form.submit(); // tsubmiti l form ken l validation cbn
                }
            });
        });
    </script>
</body>
</html>
