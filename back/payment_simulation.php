<?php
// Récupérer les données du don
$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;
$anonymous = isset($_GET['anonymous']) ? $_GET['anonymous'] : 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulation de Paiement - Bet Metaachi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Simulation de Paiement</h2>
    <p class="text-center fs-4">Montant du Don : <strong><?php echo htmlspecialchars($amount); ?></strong> Dinars</p>

    <form id="paymentForm" action="../back/process_payment.php" method="POST">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
        <input type="hidden" name="anonymous" value="<?php echo htmlspecialchars($anonymous); ?>">

        <div class="mb-3">
            <label for="card_number" class="form-label">Numéro de carte</label>
            <input type="text" class="form-control" id="card_number" name="card_number" required placeholder="Ex: 1234 5678 9012 3456" maxlength="19">
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Date d'expiration</label>
            <input type="month" class="form-control" id="expiry_date" name="expiry_date" required>
        </div>

        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" required placeholder="Ex: 123" maxlength="3">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Ex: example@mail.com">
        </div>

        <div class="mb-3">
            <label for="billing_address" class="form-label">Adresse de facturation</label>
            <input type="text" class="form-control" id="billing_address" name="billing_address" required placeholder="Ex: 123 Rue Exemple, Ville">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">Confirmer le Paiement</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
