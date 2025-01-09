<?php
$donationAmount = $_POST['donationAmount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link href="../assets/css/bootstrap.min.cs" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Merci pour votre don !</h2>
        <p class="text-center">Nous vous remercions pour votre généreux don de <strong><?= htmlspecialchars($donationAmount); ?> Dinars</strong>.</p>
    </div>
</body>
</html>
